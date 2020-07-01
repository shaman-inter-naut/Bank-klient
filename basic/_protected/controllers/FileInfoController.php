<?php

namespace app\controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use app\models\BankBranch;
use app\models\Company;
use app\models\Document;
use app\models\Bank;
use Yii;
use app\models\FileInfo;
use app\models\FileInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * FileInfoController implements the CRUD actions for FileInfo model.
 */
class FileInfoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all FileInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $company = Company::find()->all();

        $searchModel = new FileInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'company' => $company,
        ]);
    }

    public function actionDoc()
    {
        $searchModel = new FileInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single FileInfo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $allDebet = Document::find()->where(['file_id' => $id])->sum('detail_debet');
        $allKredit = Document::find()->where(['file_id' => $id])->sum('detail_kredit');

        $lastInserted = FileInfo::find()->where(['id' => $id])->one();
        $getCompanyINN = Company::find()->where(['inn' => $lastInserted->company_inn])->one();

        $get_company_name = $getCompanyINN->name;


        $company = Company::find()->where(['id' => $id])->one();


//        begin Hujjat ichini ko`rish uchun
        $document = Document::find()->where(['file_id' => $id])->all();
        $doc = Document::find()->one();

//             $debet = $doc->sum('detail_debet');
//        $cost = $silka->sum('click');
//        end Hujjat ichini ko`rish uchun


        return $this->render('view', [
            'model' => $this->findModel($id),
            'company' => $company,
            'get_company_name' => $get_company_name,
            'document' => $document,
            'debet' => $debet,
            'allDebet' => $allDebet,
            'allKredit' => $allKredit,
        ]);
    }

    /**
     * Creates a new FileInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    public function actionCreate()
    {
        $model = new FileInfo();
        if (Yii::$app->request->post()) {
            $getTemplate = Bank::find()->where(['id' => $_POST['FileInfo']['bank_id']])->one();
            $model->file = UploadedFile::getInstance($model, 'file');
            $fileName = $model->file->baseName;
            $model->file->saveAs('uploads/' . $fileName . '.' . $model->file->extension);
            $filePath = $fileName . '.' . $model->file->extension;
            $fp = fopen('uploads/' . $filePath, 'r') or die ("can't open file");

            $details = false;
            $position = 0;
            $needed_detail = -1;
            $detail_counter = 0;
            $eee = [];
            $results = [];
            $res = [];
            while ($s = fgets($fp)) {

                if ($getTemplate->template == 1) {
                    $fields = mb_convert_encoding($s, "utf-8", "windows-1251");
                    if ($details == false) {
                        $patterns = array(
                            "mfo" => "([(]\d{5}[)])",   //mfo
                            "main" => "([:\s+]\d{20})",   // main account
                            "inn" => "(ИНН:\s+\d{9})",   // inn
                            "date" => "(Изг:\d{1,2}\.\d{1,2}\.\d{4})",             // date
                            "beginDeposit" => "(Остаток на начало периода:\s+\d+\,*[^\s]+\.\d{2}?)",         // beginDeposit
                            "endDeposit" => "(Остаток на конец периода:\s+\d+\,*[^\s]+\.\d{2}?)",             // endDeposit
                            "interval" => "(Сведения о работе счета c \d{1,2}\.\d{1,2}\.\d{4} по \d{1,2}\.\d{1,2}\.\d{4})"         // date
                        );
                        foreach ($patterns as $key => $pattern) {
                            preg_match($pattern, $fields, $matches, PREG_OFFSET_CAPTURE, 0);
                            if ($matches) {
                                $results[$key] = $matches[0][0];
                            }
                        }
                    }


                    //begin   Asosiy contentni ichini o`qish
                    if (strpos($fields, "Дата   |")) {
                        $details = true;
                        $position++;
                    }
                    if ($details) $position++;
                    if ($details & $position > 3) {
                        $rrr = explode("|", $fields);
                        if (count($rrr) == 8) {
                            if (!(trim($rrr[1]) == 'Дата' || trim($rrr[1]) == 'проводки')) {
                                if (strlen(trim($rrr[0])) == 10) {
                                    $needed_detail++;
                                    $eee[$needed_detail] = $rrr;
                                } else {
                                    $eee[$needed_detail][0] = trim($eee[$needed_detail][0]) . ' ' . trim($rrr[0]);
                                    $eee[$needed_detail][1] = trim($eee[$needed_detail][1]) . ' ' . trim($rrr[1]);
                                    $eee[$needed_detail][2] = trim($eee[$needed_detail][2]) . ' ' . trim($rrr[2]);
                                    $eee[$needed_detail][3] = trim($eee[$needed_detail][3]) . ' ' . trim($rrr[3]);
                                    $eee[$needed_detail][4] = trim($eee[$needed_detail][4]) . ' ' . trim($rrr[4]);
                                    $eee[$needed_detail][5] = trim($eee[$needed_detail][5]) . ' ' . trim($rrr[5]);
                                    $eee[$needed_detail][6] = trim($eee[$needed_detail][6]) . ' ' . trim($rrr[6]);
                                    $eee[$needed_detail][7] = trim($eee[$needed_detail][7]) . ' ' . trim($rrr[7]);
                                }
                            }
                        }
                    }
                    //end     Asosiy contentni ichini o`qish
                } //***********************************************************Read from text file********************************************************
                else if ($getTemplate->template == 2) {
                    if ($details == false) {
                        $patterns = array(
                            "mfo" => "(\d+[-])",   //mfo
                            "date" => "((Изг )\d{1,2}\.\d{1,2}\.\d{4})",         // date
                            "acc" => "((Счет:\s+)\d{20})",   //mfo
                            "inn" => "((ИНН:\s)\d{9})",   // inn
                            "interval1" => "((СЧЕТА за\s+) \d{1,2}\.\d{1,2}\.\d{4})",         // date
                            "interval2" => "((посл.проводки :)\d{1,2}\.\d{1,2}\.\d{4})",         // date
                            "beginDeposit" => "(Начало дня Пассив\s+\d+\,*[^\s]+\.\d{2}?)",         // beginDeposit
                            "endDeposit" => "(Конец дня Пассив\s+\d+\,*[^\s]+\.\d{2}?)"             // endDeposit
                        );
                        foreach ($patterns as $key => $pattern) {
                            preg_match($pattern, $s, $matches, PREG_OFFSET_CAPTURE, 0);
                            if ($matches) {
                                $results[$key] = $matches[0][0];
                            }
                        }
                    }
//              begin   Asosiy contentni ichini o`qish
                    if (strpos($s, "Корреспондент:")) {
                        $details = true;
                        $position++;
                    }
                    if ($details) $position++;
                    if ($details & $position > 3) {
                        $rrr = explode("|", $s);
                        if (count($rrr) == 8) {
                            if (!(trim($rrr[1]) == 'Дата' || trim($rrr[1]) == 'проводки')) {
                                if (strlen(trim($rrr[1])) == 10) {
                                    $needed_detail++;
                                    $eee[$needed_detail] = $rrr;
                                } else {
                                    $bor = FileInfo::find()->where(['file_date' => $date, 'depozitBefore' => $beginDeposit])->one();

                                    $eee[$needed_detail][0] = trim($eee[$needed_detail][0]) . ' ' . trim($rrr[0]);
                                    $eee[$needed_detail][1] = trim($eee[$needed_detail][1]) . ' ' . trim($rrr[1]);
                                    $eee[$needed_detail][2] = trim($eee[$needed_detail][2]) . ' ' . trim($rrr[2]);
                                    $eee[$needed_detail][3] = trim($eee[$needed_detail][3]) . ' ' . trim($rrr[3]);
                                    $eee[$needed_detail][4] = trim($eee[$needed_detail][4]) . ' ' . trim($rrr[4]);
                                    $eee[$needed_detail][5] = trim($eee[$needed_detail][5]) . ' ' . trim($rrr[5]);
                                    $eee[$needed_detail][6] = trim($eee[$needed_detail][6]) . ' ' . trim($rrr[6]);
                                    $eee[$needed_detail][7] = trim($eee[$needed_detail][7]) . ' ' . trim($rrr[7]);
                                }
                            }
                        }
                    }
//              end     Asosiy contentni ichini o`qish
                } //*******************************************************************************************************************
                else if ($getTemplate->template == 3) {
                    if ($details == false) {
                        $patterns = array(
                            "acc" => "((Лицевой счет №\s+)\d{20})",   //acc
                            "inn" => "((ИНН:\s+)\d{9})",   // inn
                            "date" => "((Входящий остаток на\s+)\d{1,2}\.\d{1,2}\.\d{4})",         // date
                            "interval1" => "((\s+Выписка с\s+)\d{1,2}\.\d{1,2}\.\d{4})",         // date
                            "interval2" => "((\s+по\s+)\d{1,2}\.\d{1,2}\.\d{4})"         // date
                        );
                        foreach ($patterns as $key => $pattern) {
                            preg_match($pattern, $s, $matches, PREG_OFFSET_CAPTURE, 0);
                            if ($matches) {
                                $results[$key] = $matches[0][0];
                            }
                        }
                    }
                    // begin   Asosiy contentni ichini o`qish
                    if (strpos($s, "КОРРЕСПОНДЕНТ:")) {
                        $details = true;
                        $position++;
                    }
                    if ($details) $position++;
                    if ($details & $position > 4) {
                        $rrr = explode("│", $s);

                        if (count($rrr) == 1) {
                            $detail_counter = 1;
                        }

                        if (count($rrr) == 8) {
                            if ($detail_counter == 1) {
                                $detail_counter++;
                                $needed_detail++;
                                $eee[$needed_detail] = $rrr;
                            } else {
                                $detail_counter++;
                                $eee[$needed_detail][0] = trim($eee[$needed_detail][0]) . ' ' . trim($rrr[0]);
                                $eee[$needed_detail][1] = trim($eee[$needed_detail][1]) . ' ' . trim($rrr[1]);
                                $eee[$needed_detail][2] = trim($eee[$needed_detail][2]) . ' ' . trim($rrr[2]);
                                $eee[$needed_detail][3] = trim($eee[$needed_detail][3]) . ' ' . trim($rrr[3]);
                                $eee[$needed_detail][4] = trim($eee[$needed_detail][4]) . ' ' . trim($rrr[4]);
                                $eee[$needed_detail][5] = trim($eee[$needed_detail][5]) . ' ' . trim($rrr[5]);
                                $eee[$needed_detail][6] = trim($eee[$needed_detail][6]) . ' ' . trim($rrr[6]);
                                $eee[$needed_detail][7] = trim($eee[$needed_detail][7]) . ' ' . trim($rrr[7]);
                            }
                        }
                    }
                    //              end     Asosiy contentni ichini o`qish
                }
//*******************************************************************************************************************
            }


//***********************************************************Save to database********************************************************
            if ($getTemplate->template == 1) {
                $mfo = trim(str_replace("(", "", $results['mfo']));
                $mfo = trim(str_replace(")", "", $mfo));
                $main = trim($results['main']);
                $inn = trim(str_replace("ИНН:", "", $results['inn']));
                $date = trim(str_replace("Изг:", "", $results['date']));
                $beginDeposit = trim(str_replace("Остаток на начало периода:", "", $results['beginDeposit']));
                $beginDeposit = trim(str_replace(",", "", $beginDeposit));
                $endDeposit = trim(str_replace("Остаток на конец периода:", "", $results['endDeposit']));
                $interval = trim(str_replace("Сведения о работе счета c ", "", $results['interval']));
                $interval = str_replace(" по ", " - ", $interval);


                $model->bank_id = $_POST['FileInfo']['bank_id'];
                $model->bank_mfo = $mfo;
                $model->company_account = $main;
                $model->company_inn = $inn;
                $unikal = substr($main, 9, 8);
                $company = Company::find()->where(['unical_code' => $unikal])->one();
                $model->company_id = $company->id;
                $model->file_name = $filePath;
                $model->file_date = $date;
                $model->data_period = $interval;
                $model->depozitBefore = $beginDeposit;
                $endDeposit = trim(str_replace(",", "", $endDeposit));
                $model->depozitAfter = $endDeposit;
                $model->save(false);
                $lastID = Yii::$app->db->getLastInsertID();


                foreach ($eee as $key => $value) {
                    $pat = array(
                        "contract_date" => "((от )\d{1,2}\.\d{1,2}\.\d{4})",     //contract_date
                    );
                    foreach ($pat as $k => $p) {
                        preg_match($p, $value[4], $m, PREG_OFFSET_CAPTURE, 0);
                        if ($m) {
                            $res[$k] = $m[0][0];
                        }
                    }

                    $debet = trim(str_replace(",", "", $value[5]));
                    $kredit = trim(str_replace(",", "", $value[6]));
                    $contract_date = trim(str_replace("от", "", $res['contract_date']));

                    $document = Document::find()->where(
                        [
                            'detail_date' => $value[0],
                            'detail_document_number' => $value[2],
                            'detail_purpose_of_payment' => $value[7],
                            'detail_debet' => $debet,
                            'detail_kredit' => $kredit,
                        ])->all();
                    if (!$document) {
                        $document = new Document();
                        $document->file_id = $lastID;
                        $document->detail_date = $value[0];
                        preg_match('/(?P<acc>\d+)\s+(?P<name1>\D+)\s+(?P<inn>\d+)/', $value[1], $matches);
                        $document->detail_account = $matches['acc'];
                        $document->detail_inn = $matches['inn'];
                        $document->detail_name = '-';// $eee[1];
                        $document->detail_document_number = $value[2];
                        $document->detail_mfo = $value[4];
                        $document->detail_debet = $debet;
                        $document->detail_kredit = $kredit;
                        $document->detail_purpose_of_payment = $value[7];
                        $document->code_currency = substr($matches['acc'], 5, 3);
                        $document->contract_date = $contract_date;
                        $document->company_unikal = substr($main, 9, 8);
                        $document->save(false);
                    } else if ($document) {
                        session_start();
                        $_SESSION['file_date'] = $value[0];
                        $_SESSION['detail_document_number'] = $value[2];
                        $_SESSION['detail_purpose_of_payment'] = $value[4];
                        $_SESSION['detail_debet'] = $debet;
                        $_SESSION['detail_kredit'] = $kredit;
                        $s = 'Refresh:0; url=http://bank-klient/file-info/view?id=' . $lastID;
                        header($s);
//                            exit;
                    }
                }
                /* END Fayl import qilish va ma`lumotlarni bazaga saqlash */

            } //*******************************************************************************************************************
            else if ($getTemplate->template == 2) {
                $mfo = trim(str_replace("-", "", $results['mfo']));
                $acc = trim(str_replace("Счет:", "", $results['acc']));
                $date = trim(str_replace("Изг", "", $results['date']));
                $interval1 = trim(str_replace("СЧЕТА за", "", $results['interval1']));
                $interval2 = trim(str_replace("посл.проводки :", "", $results['interval2']));
                $interval = $interval1 . ' - ' . $interval2;
                $beginDeposit = trim(str_replace("Начало дня Пассив", "", $results['beginDeposit']));
                $beginDeposit = trim(str_replace(",", "", $beginDeposit));
                $endDeposit = trim(str_replace("Конец дня Пассив", "", $results['endDeposit']));


                $model->bank_id = $_POST['FileInfo']['bank_id'];
                $model->bank_mfo = $mfo;
                $model->company_account = $acc;
                $unikal = substr($acc, 9, 8);
                $company = Company::find()->where(['unical_code' => $unikal])->one();
                $model->company_inn = $company->inn;
                $model->file_name = $filePath;
                $model->file_date = $date;
                $model->data_period = $interval;
                $model->depozitBefore = $beginDeposit;
                $endDeposit = trim(str_replace(",", "", $endDeposit));
                $model->depozitAfter = $endDeposit;
                $model->save(false);
                $lastID = Yii::$app->db->getLastInsertID();

                foreach ($eee as $key => $value) {
                    $pat = array(
                        "mfo" => "((МФО:)\d{5})",     //mfo
                        "acc" => "((Счет:)\d{20})",   //acc
                        "inn" => "((ИНН:)\d{9})",     //inn
                        "contract_date" => "((от )\d{1,2}\.\d{1,2}\.\d{4})",     //contract_date
                    );
                    foreach ($pat as $k => $p) {
                        preg_match($p, $value[4], $m, PREG_OFFSET_CAPTURE, 0);
                        if ($m) {
                            $res[$k] = $m[0][0];
                        }
                    }

                    $inn = trim(str_replace("ИНН:", "", $res['inn']));
                    $account = trim(str_replace("Счет:", "", $res['acc']));
                    $mfo = trim(str_replace("МФО:", "", $res['mfo']));
                    $debet = trim(str_replace(",", "", $value[5]));
                    $kredit = trim(str_replace(",", "", $value[6]));
                    $contract_date = trim(str_replace("от", "", $res['contract_date']));

                    $document = Document::find()->where(
                        [
                            'detail_date' => $value[1],
                            'detail_document_number' => $value[2],
                            'detail_purpose_of_payment' => $value[4],
                            'detail_debet' => $debet,
                            'detail_kredit' => $kredit,
                        ])->all();
                    if (!$document) {
                        $document = new Document();
                        $document->file_id = $lastID;
                        $document->detail_date = $value[1];
                        $document->detail_document_number = $value[2];
                        $document->detail_inn = $inn;
                        $document->detail_account = $account;
                        $document->detail_name = '-';
                        $document->detail_mfo = $mfo;
                        $document->detail_debet = $debet;
                        $document->detail_kredit = $kredit;
                        $document->detail_purpose_of_payment = $value[4];
                        $document->code_currency = substr(trim(str_replace("Счет:", "", $res['acc'])), 5, 3);
                        $document->contract_date = $contract_date;
                        $document->company_unikal = substr($acc, 9, 8);

                        $document->save(false);
                    } else if ($document) {
                        session_start();
                        $_SESSION['file_date'] = $value[0];
                        $_SESSION['detail_document_number'] = $value[2];
                        $_SESSION['detail_purpose_of_payment'] = $value[4];
                        $_SESSION['detail_debet'] = $debet;
                        $_SESSION['detail_kredit'] = $kredit;
                        $s = 'Refresh:0; url=http://bank-klient/file-info/view?id=' . $lastID;
                        header($s);
//                            exit;
                    }
                }
            } //*******************************************************************************************************************
            else if ($getTemplate->template == 3) {
                $acc = trim(str_replace("Лицевой счет №", "", $results['acc']));
                $inn = trim(str_replace("ИНН:", "", $results['inn']));
                $date = trim(str_replace("Входящий остаток на", "", $results['date']));
                $interval1 = trim(str_replace("Выписка с", "", $results['interval1']));
                $interval2 = trim(str_replace("по", "", $results['interval2']));
                $interval = $interval1 . ' - ' . $interval2;


                $model->bank_id = $_POST['FileInfo']['bank_id'];
                $model->bank_mfo = '00014';
                $model->company_account = $acc;
                $model->company_inn = $inn;
                $model->file_name = $filePath;
                $model->file_date = $date;
                $model->data_period = $interval;
                $model->save(false);
                $lastID = Yii::$app->db->getLastInsertID();

                foreach ($eee as $key => $value) {
                    $pat = array(
                        "mfo" => "((МФО:)\d{5})",     //mfo
                        "acc" => "((Счет:)\d{20})",   //acc
                        "inn" => "((ИНН:)\d{9})",     //inn
                        "contract_date" => "((от )\d{1,2}\.\d{1,2}\.\d{4})",     //contract_date
                    );

                    foreach ($pat as $key => $p) {
                        preg_match($p, $value[4], $m, PREG_OFFSET_CAPTURE, 0);
                        if ($m) {
                            $res[$key] = $m[0][0];
                        }
                    }

                    $debet = trim(str_replace(",", "", $value[5]));
                    $kredit = trim(str_replace(",", "", $value[6]));
                    $contract_date = trim(str_replace("от", "", $res['contract_date']));

                    $document = Document::find()->where(
                        [
                            'detail_date' => $value[1],
                            'detail_document_number' => $value[2],
                            'detail_purpose_of_payment' => $value[4],
                            'detail_debet' => $debet,
                            'detail_kredit' => $kredit,
                        ])->all();
                    if (!$document) {
                        $document = new Document();
                        $document->file_id = $lastID;
                        $document->detail_date = $value[1];
                        $document->detail_document_number = $value[2];
                        $document->detail_inn = trim(str_replace("ИНН:", "", $res['inn']));
                        $document->detail_account = trim(str_replace("Счет:", "", $res['acc']));
                        $document->detail_name = '-';
                        $document->detail_mfo = trim(str_replace("МФО:", "", $res['mfo']));
                        $document->detail_debet = $debet;
                        $document->detail_kredit = $kredit;
                        $document->detail_purpose_of_payment = $value[4];
                        $document->code_currency = substr(trim(str_replace("Счет:", "", $res['acc'])), 5, 3);

                        $document->contract_date = $contract_date;
                        $document->company_unikal = substr($acc, 9, 8);
                        $document->save(false);
                    } else if ($document) {
                        session_start();
                        $_SESSION['file_date'] = $value[0];
                        $_SESSION['detail_document_number'] = $value[2];
                        $_SESSION['detail_purpose_of_payment'] = $value[4];
                        $_SESSION['detail_debet'] = $debet;
                        $_SESSION['detail_kredit'] = $kredit;
                        $s = 'Refresh:0; url=http://bank-klient/file-info/view?id=' . $lastID;
                        header($s);
//                            exit;
                    }
                }
            }

        }


        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view',
                'id' => $model->id,
            ]);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'fileName' => $fileName,
        ]);
    }


    /**
     * Updates an existing FileInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $fayl = FileInfo::find()->where(['id' => $id])->one();


        if ($model->load(Yii::$app->request->post())) {

            $fayl->bank_mfo = $model->bank_mfo;
            $fayl->company_account = $model->company_account;
            $fayl->company_inn = $model->company_inn;
            $fayl->file_name = $model->file_name;
            $fayl->file_date = $model->file_date;
            $fayl->data_period = $model->data_period;
            $fayl->save(false);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
//            'fayl' => $fayl,
        ]);
    }

    /**
     * Deletes an existing FileInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FileInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FileInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FileInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionToSpreed()
    {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Ширина задается в количестве символов.
        $sheet->getColumnDimension('A')->setWidth(5);//№
        $sheet->getColumnDimension('B')->setWidth(33);//Корхоналар
        $sheet->getColumnDimension('C')->setWidth(18);//Уникальный код
        $sheet->getColumnDimension('D')->setWidth(27);//UZS
        $sheet->getColumnDimension('E')->setWidth(27);//USD
        $sheet->getColumnDimension('F')->setWidth(27);//EUR
        $sheet->getColumnDimension('G')->setWidth(27);//RUB
        $sheet->getColumnDimension('H')->setWidth(27);//Аккредитив (USD)
        $sheet->getColumnDimension('I')->setWidth(27);//Аккредитив (EUR)
        $sheet->getColumnDimension('J')->setWidth(27);//Аккредитив (RUB)
        $sheet->getColumnDimension('K')->setWidth(27);//Блок счёт (UZS)
        $sheet->getColumnDimension('L')->setWidth(27);//Блок счёт (USD)
        $sheet->getColumnDimension('M')->setWidth(27);//Блок счёт (RUB)
        $sheet->getColumnDimension('N')->setWidth(27);//Блок счёт (EUR)Депозит (UZS)
        $sheet->getColumnDimension('O')->setWidth(27);//Депозит (UZS)
        $sheet->getColumnDimension('P')->setWidth(27);//Депозит (USD)
        $sheet->getColumnDimension('Q')->setWidth(27);//Депозит (EUR)
        $sheet->getColumnDimension('R')->setWidth(27);//Депозит (RUB)
        $sheet->getColumnDimension('S')->setWidth(35);//Корпоратив карта


        //  Для удобства заводим переменную $line, в ней будем считать номер строки.
        $line = 1;
        $sheet->setCellValue('A' . $line, 'Информация о  потребности в сумовых денежных средствах предприятий локализации ' . date('d.m.Y H:i'));

        // Объединяем ячейки по горизонтали.
        $sheet->mergeCells('A' . $line . ':S' . $line);
        //$sheet->getStyle('A'.$line.':S'.$line)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);


        //Делаем текст жирным и увеличиваем шрифт.
        $sheet->getStyle("A" . $line)->getFont()->setBold(true);
        $sheet->getStyle("A" . $line)->getFont()->setSize(14);

        // Пропускаем строку после заголовка.
        $line++;
        $sheet->setCellValue("A" . $line, '');
        $sheet->mergeCells("A" . $line . ":S" . $line);

        //Информация
        $line++;
        $sheet->mergeCells('A' . (1) . ':A' . (6));
        $sheet->setCellValue("A" . $line, '№:');
        $sheet->mergeCells('B' . (1) . ':B' . (6));
        $sheet->setCellValue("B" . $line, 'Корхоналар');
        $sheet->mergeCells('C' . (1) . ':C' . (6));
        $sheet->setCellValue("C" . $line, 'Уникальный код');
        $sheet->setCellValue("D" . $line, 'ОСТАТОК');
        $sheet->mergeCells("D" . $line . ":R" . $line);
        //$sheet->getStyle('D'.$line.':R'.$line)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);


        //Информация
        $line++;
        $sheet->setCellValue("A" . $line, '');
        $sheet->setCellValue("B" . $line, '');
        $sheet->setCellValue("C" . $line, '');
        $sheet->setCellValue("D" . $line, 'Асосий хисоб рақам');
        $sheet->mergeCells("D" . $line . ":G" . $line);
//            $sheet->setCellValue("E".$line, 'Корхона Х/Р');
//            $sheet->setCellValue("F".$line, 'Документ санаси');
//            $sheet->setCellValue("G".$line, 'Оралиқ давр');
//            $sheet->setCellValue("H".$line, 'Бошланғич депозит');
        $sheet->setCellValue("H" . $line, 'Махсус хисоб рақам');
        //           $sheet->setCellValue("J".$line, 'Хамкор корхона номи');
        //           $sheet->setCellValue("K".$line, 'Хамкор корхона х/р');
        //           $sheet->setCellValue("L".$line, 'Документ рақами');
        //           $sheet->setCellValue("M".$line, 'Дебет');
        //           $sheet->setCellValue("N".$line, 'Кредит');
        //           $sheet->setCellValue("O".$line, 'Тўлов мақсади');
        $sheet->mergeCells("H" . $line . ":N" . $line);
        $sheet->setCellValue("O" . $line, 'Депозит хисоб рақам');
        //           $sheet->setCellValue("Q{$line}", 'Шартнома рақами');
        //           $sheet->setCellValue("R{$line}", 'Шартнома санаси');
        //           $sheet->setCellValue("R{$line}", 'Шартнома санаси');
        $sheet->mergeCells("O" . $line . ":R" . $line);
        $sheet->setCellValue("S" . $line, 'Корпоратив карта');

        $line++;
        $sheet->setCellValue("A" . $line, '');
        $sheet->setCellValue("B" . $line, '');
        $sheet->setCellValue("C" . $line, '');
        $sheet->setCellValue("D" . $line, 'UZS');
        $sheet->setCellValue("E" . $line, 'USD');
        $sheet->setCellValue("F" . $line, 'EUR');
        $sheet->setCellValue("G" . $line, 'RUB');
        $sheet->setCellValue("H" . $line, 'Акккредитив (USD)');
        $sheet->setCellValue("I" . $line, 'Акккредитив (EUR)');
        $sheet->setCellValue("J" . $line, 'Акккредитив (RUB)');
        $sheet->setCellValue("K" . $line, 'Блок счёт (UZS)');
        $sheet->setCellValue("L" . $line, 'Блок счёт (USD)');
        $sheet->setCellValue("M" . $line, 'Блок счёт (EUR)');
        $sheet->setCellValue("N" . $line, 'Блок счёт (RUB)');
        $sheet->setCellValue("O" . $line, 'Депозит (UZS)');
        $sheet->setCellValue("P" . $line, 'Депозит (USD)');
        $sheet->setCellValue("Q" . $line, 'Депозит (EUR)');
        $sheet->setCellValue("R" . $line, 'Депозит (RUB)');
        $sheet->setCellValue("S" . $line, '');


        $line++;
        $sheet->setCellValue("A" . $line, '');
        $sheet->setCellValue("B" . $line, '');
        $sheet->setCellValue("C" . $line, '');
        $sheet->setCellValue("D" . $line, '20208000/20210000/20214000');
        $sheet->setCellValue("E" . $line, '20208840/20210840/20214840');
        $sheet->setCellValue("F" . $line, '20208978/20210978/20214978');
        $sheet->setCellValue("G" . $line, '20208643/20210643/20214643');
        $sheet->setCellValue("H" . $line, '22602000');
        $sheet->setCellValue("I" . $line, '22602840');
        $sheet->setCellValue("J" . $line, '22602978');
        $sheet->setCellValue("K" . $line, '22613000');
        $sheet->setCellValue("L" . $line, '22618840');
        $sheet->setCellValue("M" . $line, '22614978');
        $sheet->setCellValue("N" . $line, '22614978');
        $sheet->setCellValue("O" . $line, '20614000');
        $sheet->setCellValue("P" . $line, '20614840');
        $sheet->setCellValue("Q" . $line, '20614978');
        $sheet->setCellValue("R" . $line, '20614643');
        $sheet->setCellValue("S" . $line, '22620');


// ****************************************************************** 20208000 + 20210000 + 20214000
        $companyName = Company::find()->limit(23)->all();

        $nUZS = ['20208000', '20210000', '20214000'];

        foreach ($nUZS as $key_nUZS => $value_nUZS) {
            $fileUZS = FileInfo::find()->where(['like', 'company_account', $value_nUZS])->all();
            foreach ($fileUZS as $key_fileUZS => $value_fileUZS) {
                $company_unikalUZS = substr($value_fileUZS->company_account, 9, 8);
                //echo $company_unikal."<br>";
                $documentUZS = Document::find()->where(['file_id' => $value_fileUZS->id])->all();
                foreach ($documentUZS as $kUZS => $valUZS) {
                    // $val->detail_kredit.'<br>';
                    $summaUZS[$company_unikalUZS][$value_nUZS] += $valUZS->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';

// ****************************************************************** 20208840 + 20210840 + 20214840

        $nUSD = ['20208840', '20210840', '20214840'];

        foreach ($nUSD as $key_nUSD => $value_nUSD) {
            $fileUSD = FileInfo::find()->where(['like', 'company_account', $value_nUSD])->all();
            foreach ($fileUSD as $key_fileUSD => $value_fileUSD) {
                $company_unikalUSD = substr($value_fileUSD->company_account, 9, 8);
                $documentUSD = Document::find()->where(['file_id' => $value_fileUSD->id])->all();
                foreach ($documentUSD as $kUSD => $valUSD) {
                    $summaUSD[$company_unikalUSD][$value_nUSD] += $valUSD->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';


// ****************************************************************** 20208978 + 20210978 + 20214978

        $nEUR = ['20208978', '20210978', '20214978'];

        foreach ($nEUR as $key_nEUR => $value_nEUR) {
            $fileEUR = FileInfo::find()->where(['like', 'company_account', $value_nEUR])->all();
            foreach ($fileEUR as $key_fileEUR => $value_fileEUR) {
                $company_unikalEUR = substr($value_fileEUR->company_account, 9, 8);
                $documentEUR = Document::find()->where(['file_id' => $value_fileEUR->id])->all();
                foreach ($documentEUR as $kEUR => $valEUR) {
                    $summaEUR[$company_unikalEUR][$value_nEUR] += $valEUR->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';


// ****************************************************************** 20208643 + 20210643 + 20214643

        $nRUB = ['20208643', '20210643', '20214643'];

        foreach ($nRUB as $key_nRUB => $value_nRUB) {
            $fileRUB = FileInfo::find()->where(['like', 'company_account', $value_nRUB])->all();
            foreach ($fileRUB as $key_fileRUB => $value_fileRUB) {
                $company_unikalRUB = substr($value_fileRUB->company_account, 9, 8);
                $documentRUB = Document::find()->where(['file_id' => $value_fileRUB->id])->all();
                foreach ($documentRUB as $kRUB => $valRUB) {
                    $summaRUB[$company_unikalRUB][$value_nRUB] += $valRUB->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';


// ****************************************************************** 22602000

        $nAkkrUZS = ['22602000'];

        foreach ($nAkkrUZS as $key_nAkkrUZS => $value_nAkkrUZS) {
            $fileAkkrUZS = FileInfo::find()->where(['like', 'company_account', $value_nAkkrUZS])->all();
            foreach ($fileAkkrUZS as $key_fileAkkrUZS => $value_fileAkkrUZS) {
                $company_unikalAkkrUZS = substr($value_fileAkkrUZS->company_account, 9, 8);
                $documentAkkrUZS = Document::find()->where(['file_id' => $value_fileAkkrUZS->id])->all();
                foreach ($documentAkkrUZS as $kAkkrUZS => $valAkkrUZS) {
                    $summaAkkrUZS[$company_unikalAkkrUZS][$value_nAkkrUZS] += $valAkkrUZS->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';


// ****************************************************************** 22602840

        $nAkkrEUR = ['22602840'];

        foreach ($nAkkrEUR as $key_nAkkrEUR => $value_nAkkrEUR) {
            $fileAkkrEUR = FileInfo::find()->where(['like', 'company_account', $value_nAkkrEUR])->all();
            foreach ($fileAkkrEUR as $key_fileAkkrEUR => $value_fileAkkrEUR) {
                $company_unikalAkkrEUR = substr($value_fileAkkrEUR->company_account, 9, 8);
                $documentAkkrEUR = Document::find()->where(['file_id' => $value_fileAkkrEUR->id])->all();
                foreach ($documentAkkrEUR as $kAkkrEUR => $valAkkrEUR) {
                    $summaAkkrEUR[$company_unikalAkkrEUR][$value_nAkkrEUR] += $valAkkrEUR->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';


// ****************************************************************** 22602978

        $nAkkrRUB = ['22602978'];

        foreach ($nAkkrRUB as $key_nAkkrRUB => $value_nAkkrRUB) {
            $fileAkkrRUB = FileInfo::find()->where(['like', 'company_account', $value_nAkkrRUB])->all();
            foreach ($fileAkkrRUB as $key_fileAkkrRUB => $value_fileAkkrRUB) {
                $company_unikalAkkrRUB = substr($value_fileAkkrRUB->company_account, 9, 8);
                $documentAkkrRUB = Document::find()->where(['file_id' => $value_fileAkkrRUB->id])->all();
                foreach ($documentAkkrRUB as $kAkkrRUB => $valAkkrRUB) {
                    $summaAkkrRUB[$company_unikalAkkrRUB][$value_nAkkrRUB] += $valAkkrRUB->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';


// ****************************************************************** 22613000

        $nBlokUZS = ['22613000'];

        foreach ($nBlokUZS as $key_nBlokUZS => $value_nBlokUZS) {
            $fileBlokUZS = FileInfo::find()->where(['like', 'company_account', $value_nBlokUZS])->all();
            foreach ($fileBlokUZS as $key_fileBlokUZS => $value_fileBlokUZS) {
                $company_unikalBlokUZS = substr($value_fileBlokUZS->company_account, 9, 8);
                $documentBlokUZS = Document::find()->where(['file_id' => $value_fileBlokUZS->id])->all();
                foreach ($documentBlokUZS as $kBlokUZS => $valBlokUZS) {
                    $summaBlokUZS[$company_unikalBlokUZS][$value_nBlokUZS] += $valBlokUZS->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';


// ****************************************************************** 22613840

        $nBlokUSD = ['22613840'];

        foreach ($nBlokUSD as $key_nBlokUSD => $value_nBlokUSD) {
            $fileBlokUSD = FileInfo::find()->where(['like', 'company_account', $value_nBlokUSD])->all();
            foreach ($fileBlokUSD as $key_fileBlokUSD => $value_fileBlokUSD) {
                $company_unikalBlokUSD = substr($value_fileBlokUSD->company_account, 9, 8);
                $documentBlokUSD = Document::find()->where(['file_id' => $value_fileBlokUSD->id])->all();
                foreach ($documentBlokUSD as $kBlokUSD => $valBlokUSD) {
                    $summaBlokUSD[$company_unikalBlokUSD][$value_nBlokUSD] += $valBlokUSD->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';


// ****************************************************************** 22613978

        $nBlokEUR = ['22613978'];

        foreach ($nBlokEUR as $key_nBlokEUR => $value_nBlokEUR) {
            $fileBlokEUR = FileInfo::find()->where(['like', 'company_account', $value_nBlokEUR])->all();
            foreach ($fileBlokEUR as $key_fileBlokEUR => $value_fileBlokEUR) {
                $company_unikalBlokEUR = substr($value_fileBlokEUR->company_account, 9, 8);
                $documentBlokEUR = Document::find()->where(['file_id' => $value_fileBlokEUR->id])->all();
                foreach ($documentBlokEUR as $kBlokEUR => $valBlokEUR) {
                    $summaBlokEUR[$company_unikalBlokEUR][$value_nBlokEUR] += $valBlokEUR->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';


// ****************************************************************** 22613643

        $nBlokRUB = ['22613643'];

        foreach ($nBlokRUB as $key_nBlokRUB => $value_nBlokRUB) {
            $fileBlokRUB = FileInfo::find()->where(['like', 'company_account', $value_nBlokRUB])->all();
            foreach ($fileBlokRUB as $key_fileBlokRUB => $value_fileBlokRUB) {
                $company_unikalBlokRUB = substr($value_fileBlokRUB->company_account, 9, 8);
                $documentBlokRUB = Document::find()->where(['file_id' => $value_fileBlokRUB->id])->all();
                foreach ($documentBlokRUB as $kBlokRUB => $valBlokRUB) {
                    $summaBlokRUB[$company_unikalBlokRUB][$value_nBlokRUB] += $valBlokRUB->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';


// ****************************************************************** 20614000

        $nDepUZS = ['20614000'];

        foreach ($nDepUZS as $key_nDepUZS => $value_nDepUZS) {
            $fileDepUZS = FileInfo::find()->where(['like', 'company_account', $value_nDepUZS])->all();
            foreach ($fileDepUZS as $key_fileDepUZS => $value_fileDepUZS) {
                $company_unikalDepUZS = substr($value_fileDepUZS->company_account, 9, 8);
                $documentDepUZS = Document::find()->where(['file_id' => $value_fileDepUZS->id])->all();
                foreach ($documentDepUZS as $kDepUZS => $valDepUZS) {
                    $summaDepUZS[$company_unikalDepUZS][$value_nDepUZS] += $valDepUZS->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';


// ****************************************************************** 20614840

        $nDepUSD = ['20614840'];

        foreach ($nDepUSD as $key_nDepUSD => $value_nDepUSD) {
            $fileDepUSD = FileInfo::find()->where(['like', 'company_account', $value_nDepUSD])->all();
            foreach ($fileDepUSD as $key_fileDepUSD => $value_fileDepUSD) {
                $company_unikalDepUSD = substr($value_fileDepUSD->company_account, 9, 8);
                $documentDepUSD = Document::find()->where(['file_id' => $value_fileDepUSD->id])->all();
                foreach ($documentDepUSD as $kDepUSD => $valDepUSD) {
                    $summaDepUSD[$company_unikalDepUSD][$value_nDepUSD] += $valDepUSD->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';

// ****************************************************************** 20614978

        $nDepEUR = ['20614978'];

        foreach ($nDepEUR as $key_nDepEUR => $value_nDepEUR) {
            $fileDepEUR = FileInfo::find()->where(['like', 'company_account', $value_nDepEUR])->all();
            foreach ($fileDepEUR as $key_fileDepEUR => $value_fileDepEUR) {
                $company_unikalDepEUR = substr($value_fileDepEUR->company_account, 9, 8);
                $documentDepEUR = Document::find()->where(['file_id' => $value_fileDepEUR->id])->all();
                foreach ($documentDepEUR as $kDepEUR => $valDepEUR) {
                    $summaDepEUR[$company_unikalDepEUR][$value_nDepEUR] += $valDepEUR->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';


// ****************************************************************** 20614643

        $nDepRUB = ['20614643'];

        foreach ($nDepRUB as $key_nDepRUB => $value_nDepRUB) {
            $fileDepRUB = FileInfo::find()->where(['like', 'company_account', $value_nDepRUB])->all();
            foreach ($fileDepRUB as $key_fileDepRUB => $value_fileDepRUB) {
                $company_unikalDepRUB = substr($value_fileDepRUB->company_account, 9, 8);
                $documentDepRUB = Document::find()->where(['file_id' => $value_fileDepRUB->id])->all();
                foreach ($documentDepRUB as $kDepRUB => $valDepRUB) {
                    $summaDepRUB[$company_unikalDepRUB][$value_nDepRUB] += $valDepRUB->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';


// ****************************************************************** 22620

        $nKorpKarta = ['22620'];

        foreach ($nKorpKarta as $key_nKorpKarta => $value_nKorpKarta) {
            $fileKorpKarta = FileInfo::find()->where(['like', 'company_account', $value_nKorpKarta])->all();
            foreach ($fileKorpKarta as $key_fileKorpKarta => $value_fileKorpKarta) {
                $company_unikalKorpKarta = substr($value_fileKorpKarta->company_account, 9, 8);
                $documentKorpKarta = Document::find()->where(['file_id' => $value_fileKorpKarta->id])->all();
                foreach ($documentKorpKarta as $kKorpKarta => $valKorpKarta) {
                    $summaKorpKarta[$company_unikalKorpKarta][$value_nKorpKarta] += $valKorpKarta->detail_kredit;
                }
            }
        }

        // echo array_sum($dk20214);
        // echo '<hr><hr>';


        $line++;

        foreach ($companyName as $i => $cName) {
            $sheet->setCellValue("A" . $line, $i);
            $sheet->setCellValue("B" . $line, $cName->name);
            $sheet->setCellValue("C" . $line, $cName->unical_code);

            $new_arrayUZS = $summaUZS[$cName->unical_code] ? $summaUZS[$cName->unical_code] : [];
            $sheet->setCellValue("D" . $line, array_sum($new_arrayUZS));
            $sum_new_arrayUZS += array_sum($new_arrayUZS);

            $new_arrayUSD = $summaUSD[$cName->unical_code] ? $summaUSD[$cName->unical_code] : [];
            $sheet->setCellValue("E" . $line, array_sum($new_arrayUSD));
            $sum_new_arrayUSD += array_sum($new_arrayUSD);

            $new_arrayEUR = $summaEUR[$cName->unical_code] ? $summaEUR[$cName->unical_code] : [];
            $sheet->setCellValue("F" . $line, array_sum($new_arrayEUR));
            $sum_new_arrayEUR += array_sum($new_arrayEUR);

            $new_arrayRUB = $summaRUB[$cName->unical_code] ? $summaRUB[$cName->unical_code] : [];
            $sheet->setCellValue("G" . $line, array_sum($new_arrayRUB));
            $sum_new_arrayRUB += array_sum($new_arrayRUB);

            $new_arrayAkkrUZS = $summaAkkrUZS[$cName->unical_code] ? $summaAkkrUZS[$cName->unical_code] : [];
            $sheet->setCellValue("H" . $line, array_sum($new_arrayAkkrUZS));
            $sum_new_arrayAkkrUZS += array_sum($new_arrayAkkrUZS);

            $new_arrayAkkrEUR = $summaAkkrEUR[$cName->unical_code] ? $summaAkkrEUR[$cName->unical_code] : [];
            $sheet->setCellValue("I" . $line, array_sum($new_arrayAkkrEUR));
            $sum_new_arrayAkkrEUR += array_sum($new_arrayAkkrEUR);

            $new_arrayAkkrRUB = $summaAkkrRUB[$cName->unical_code] ? $summaAkkrRUB[$cName->unical_code] : [];
            $sheet->setCellValue("J" . $line, array_sum($new_arrayAkkrRUB));
            $sum_new_arrayAkkrRUB += array_sum($new_arrayAkkrRUB);


            $new_arrayBlokUZS = $summaBlokUZS[$cName->unical_code] ? $summaBlokUZS[$cName->unical_code] : [];
            $sheet->setCellValue("K" . $line, array_sum($new_arrayBlokUZS));
            $sum_new_arrayBlokUZS += array_sum($new_arrayBlokUZS);


            $new_arrayBlokUSD = $summaBlokUSD[$cName->unical_code] ? $summaBlokUSD[$cName->unical_code] : [];
            $sheet->setCellValue("L" . $line, array_sum($new_arrayBlokUSD));
            $sum_new_arrayBlokUSD += array_sum($new_arrayBlokUSD);


            $new_arrayBlokEUR = $summaBlokEUR[$cName->unical_code] ? $summaBlokEUR[$cName->unical_code] : [];
            $sheet->setCellValue("M" . $line, array_sum($new_arrayBlokEUR));
            $sum_new_arrayBlokEUR += array_sum($new_arrayBlokEUR);


            $new_arrayBlokRUB = $summaBlokRUB[$cName->unical_code] ? $summaBlokRUB[$cName->unical_code] : [];
            $sheet->setCellValue("N" . $line, array_sum($new_arrayBlokRUB));
            $sum_new_arrayBlokRUB += array_sum($new_arrayBlokRUB);


            $new_arrayDepUZS = $summaDepUZS[$cName->unical_code] ? $summaDepUZS[$cName->unical_code] : [];
            $sheet->setCellValue("O" . $line, array_sum($new_arrayDepUZS));
            $sum_new_arrayDepUZS += array_sum($new_arrayDepUZS);


            $new_arrayDepUSD = $summaDepUSD[$cName->unical_code] ? $summaDepUSD[$cName->unical_code] : [];
            $sheet->setCellValue("P" . $line, array_sum($new_arrayDepUSD));
            $sum_new_arrayDepUSD += array_sum($new_arrayDepUSD);


            $new_arrayDepEUR = $summaDepEUR[$cName->unical_code] ? $summaDepEUR[$cName->unical_code] : [];
            $sheet->setCellValue("Q" . $line, array_sum($new_arrayDepEUR));
            $sum_new_arrayDepEUR += array_sum($new_arrayDepEUR);


            $new_arrayDepRUB = $summaDepRUB[$cName->unical_code] ? $summaDepRUB[$cName->unical_code] : [];
            $sheet->setCellValue("R" . $line, array_sum($new_arrayDepRUB));
            $sum_new_arrayDepRUB += array_sum($new_arrayDepRUB);


            $new_arrayKorpKarta = $summaKorpKarta[$cName->unical_code] ? $summaKorpKarta[$cName->unical_code] : [];
            $sheet->setCellValue("S" . $line, array_sum($new_arrayKorpKarta));
            $sum_new_arrayKorpKarta += array_sum($new_arrayKorpKarta);

            $line++;
        }

        $sheet->setCellValue("D" . $line, $dk20208);

        $line++;
        $sheet->setCellValue("A" . $line, '');
        $sheet->setCellValue("B" . $line, 'Итого');
        $sheet->setCellValue("C" . $line, '');
        $sheet->setCellValue("D" . $line, round($sum_new_arrayUZS, 2));
        $sheet->setCellValue("E" . $line, round($sum_new_arrayUSD, 2));
        $sheet->setCellValue("F" . $line, round($sum_new_arrayEUR, 2));
        $sheet->setCellValue("G" . $line, round($sum_new_arrayRUB, 2));
        $sheet->setCellValue("H" . $line, round($sum_new_arrayAkkrUZS, 2));
        $sheet->setCellValue("I" . $line, round($sum_new_arrayAkkrEUR, 2));
        $sheet->setCellValue("J" . $line, round($sum_new_arrayAkkrRUB, 2));
        $sheet->setCellValue("K" . $line, round($sum_new_arrayBlokUZS, 2));
        $sheet->setCellValue("L" . $line, round($sum_new_arrayBlokUSD, 2));
        $sheet->setCellValue("M" . $line, round($sum_new_arrayBlokEUR, 2));
        $sheet->setCellValue("N" . $line, round($sum_new_arrayBlokRUB, 2));
        $sheet->setCellValue("O" . $line, round($sum_new_arrayDepUZS, 2));
        $sheet->setCellValue("P" . $line, round($sum_new_arrayDepUSD, 2));
        $sheet->setCellValue("Q" . $line, round($sum_new_arrayDepEUR, 2));
        $sheet->setCellValue("R" . $line, round($sum_new_arrayDepRUB, 2));
        $sheet->setCellValue("S" . $line, round($sum_new_arrayKorpKarta, 2));


        function getName($n)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
            return $randomString;
        }


        //Файл готов
        //Отдаем его браузеру на скачивание
//        header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
//        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//        header("Cache-Control: no-cache, must-revalidate");
//        header("Pragma: no-cache");
//        $date = date('d.m.Y H:m:s');
//        header("Content-type: application/vnd.ms-excel");
//        header("Content-Disposition: attachment; filename=order.xlsx");

        $path_name = 'C:/Сводные отчёты/';

        if (!is_dir($path_name)) {
            mkdir($path_name);
        }

        $writer = new Xlsx($spreadsheet);
        $date = date('d.m.Y - H.m.s');
        $writer->save($path_name . "Сводный отчёт (" . $date . ").xlsx");

        $info = "Ms Excel га юкланган файл ушбу манзилга сақланди: " . $path_name . "Сводный отчёт (" . $date . ").xlsx";

        return $this->goHome(['info' => $info]);


    }

}