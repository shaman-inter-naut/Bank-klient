<?php

namespace app\controllers;

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


        if ($model->load(Yii::$app->request->post()) ) {

            $fayl->bank_mfo = $model->bank_mfo;
            $fayl->company_account = $model->company_account;
            $fayl->company_inn = $model->company_inn;
            $fayl->file_name = $model->file_name;
            $fayl->file_date = $model->file_date;
            $fayl->data_period = $model->data_period;
            $fayl->save(false);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
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



    public function actionToExcel()
    {

      //  date_default_timezone_set('Europe/London');
     //   if (PHP_SAPI == 'cli') die('This example should only be run from a Web Browser');
      //  require_once $_SERVER['DOCUMENT_ROOT']."/_protected/vendor/phpoffice/phpexcel/Classes/PHPExcel.php";/* подключаем класс */
        //$objPHPExcel = new PHPExcel();


//        $app = Yii::createWebApplication($config);
//        // adding PHPExcel autoloader
//        Yii::import('application.vendors.*');
//        require_once __DIR__ . '/PHPExcel/Classes/PHPExcel.php';
//        require_once __DIR__ . '/PHPExcel/Classes/Autoloader.php';
//        require_once __DIR__ . '/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
//        Yii::registerAutoloader(array('PHPExcel_Autoloader','Load'), true);
//        $app->run();

//        if ($model->load(Yii::$app->request->post()) ) {
//        composer require phpoffice/phpexcel
//        require_once __DIR__ . '/PHPExcel/Classes/PHPExcel.php';
//        require_once __DIR__ . '/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
       // require_once(Yii::getAlias('@vendor/phpoffice/phpexcel/Classes/PHPExcel.php'));

        //require( __DIR__ . '\protected\extensions\PHPExcel/Autoloader.php');

        //Создаем экземпляр класса PHPExcel.
        $xls = new \PHPExcel();

        // Писать будем в первый лист.
        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();

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
//            $sheet->getColumnDimension('Q')->setWidth(10);//

        //        Для удобства заводим переменную $line, в ней будем считать номер строки.
        $line = 1;
        $sheet->setCellValue("A{$line}", 'Информация о  потребности в сумовых денежных средствах предприятий локализации ' . date('d.m.Y H:i'));

        //        Объединяем ячейки по горизонтали.
        $sheet->mergeCells("A{$line}:R{$line}");
        $sheet->getStyle("A{$line}:R{$line}")->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);


        //Делаем текст жирным и увеличиваем шрифт.
        $sheet->getStyle("A{$line}")->getFont()->setBold(true);
        $sheet->getStyle("A{$line}")->getFont()->setSize(14);

        // Пропускаем строку после заголовка.
        $line++;
        $sheet->setCellValue("A{$line}", '');
        $sheet->mergeCells("A{$line}:P{$line}");

        //Информация о поставщике
        $line++;
        $sheet->mergeCells('A'.(1).':A'.(6));
        $sheet->setCellValue("A{$line}", '№:');
        $sheet->mergeCells('B'.(1).':B'.(6));
        $sheet->setCellValue("B{$line}", 'Корхоналар');
        $sheet->mergeCells('C'.(1).':C'.(6));
        $sheet->setCellValue("C{$line}", 'Уникальный код');
        $sheet->setCellValue("D{$line}", 'ОСТАТОК');
        $sheet->mergeCells("D{$line}:R{$line}");
        $sheet->getStyle("D{$line}:R{$line}")->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);


//        Информация о поставщике
            $line++;
            $sheet->setCellValue("A{$line}", '');
            $sheet->setCellValue("B{$line}", '');
            $sheet->setCellValue("C{$line}", '');
            $sheet->setCellValue("D{$line}", 'Асосий хисоб рақам');
            $sheet->mergeCells("D{$line}:G{$line}");
//            $sheet->setCellValue("E{$line}", 'Корхона Х/Р');
//            $sheet->setCellValue("F{$line}", 'Документ санаси');
//            $sheet->setCellValue("G{$line}", 'Оралиқ давр');
//            $sheet->setCellValue("H{$line}", 'Бошланғич депозит');
            $sheet->setCellValue("H{$line}", 'Махсус хисоб рақам');
 //           $sheet->setCellValue("J{$line}", 'Хамкор корхона номи');
 //           $sheet->setCellValue("K{$line}", 'Хамкор корхона х/р');
 //           $sheet->setCellValue("L{$line}", 'Документ рақами');
 //           $sheet->setCellValue("M{$line}", 'Дебет');
 //           $sheet->setCellValue("N{$line}", 'Кредит');
 //           $sheet->setCellValue("O{$line}", 'Тўлов мақсади');
            $sheet->mergeCells("H{$line}:N{$line}");
            $sheet->setCellValue("O{$line}", 'Депозит хисоб рақам');
 //           $sheet->setCellValue("Q{$line}", 'Шартнома рақами');
 //           $sheet->setCellValue("R{$line}", 'Шартнома санаси');
 //           $sheet->setCellValue("R{$line}", 'Шартнома санаси');
            $sheet->mergeCells("O{$line}:R{$line}");
            $sheet->setCellValue("S{$line}", 'Корпоратив карта');

        $line++;
        $sheet->setCellValue("A{$line}", '');
        $sheet->setCellValue("B{$line}", '');
        $sheet->setCellValue("C{$line}", '');
        $sheet->setCellValue("D{$line}", 'UZS');
        $sheet->setCellValue("E{$line}", 'USD');
        $sheet->setCellValue("F{$line}", 'EUR');
        $sheet->setCellValue("G{$line}", 'RUB');
        $sheet->setCellValue("H{$line}", 'Акккредитив (USD)');
        $sheet->setCellValue("I{$line}", 'Акккредитив (EUR)');
        $sheet->setCellValue("J{$line}", 'Акккредитив (RUB)');
        $sheet->setCellValue("K{$line}", 'Блок счёт (UZS)');
        $sheet->setCellValue("L{$line}", 'Блок счёт (USD)');
        $sheet->setCellValue("M{$line}", 'Блок счёт (EUR)');
        $sheet->setCellValue("N{$line}", 'Блок счёт (RUB)');
        $sheet->setCellValue("O{$line}", 'Депозит (UZS)');
        $sheet->setCellValue("P{$line}", 'Депозит (USD)');
        $sheet->setCellValue("Q{$line}", 'Депозит (EUR)');
        $sheet->setCellValue("R{$line}", 'Депозит (RUB)');
        $sheet->setCellValue("S{$line}", '');
        //   $sheet->mergeCells("B{$line}:G{$line}");


        $line++;
            $sheet->setCellValue("A{$line}", '');
            $sheet->setCellValue("B{$line}", '');
            $sheet->setCellValue("C{$line}", '');
            $sheet->setCellValue("D{$line}", '20208000/20210000/20214000');
            $sheet->setCellValue("E{$line}", '20208840/20210840/20214840');
            $sheet->setCellValue("F{$line}", '20208978/20210978/20214978');
            $sheet->setCellValue("G{$line}", '20208643/20210643/20214643');
            $sheet->setCellValue("H{$line}", '22602000');
            $sheet->setCellValue("I{$line}", '22602840');
            $sheet->setCellValue("J{$line}", '22602978');
            $sheet->setCellValue("K{$line}", '22613000');
            $sheet->setCellValue("L{$line}", '22618840');
            $sheet->setCellValue("M{$line}", '22614978');
            $sheet->setCellValue("N{$line}", '22614978');
            $sheet->setCellValue("O{$line}", '20614000');
            $sheet->setCellValue("P{$line}", '20614840');
            $sheet->setCellValue("Q{$line}", '20614978');
            $sheet->setCellValue("R{$line}", '20614643');
            $sheet->setCellValue("S{$line}", '22620');
       //   $sheet->mergeCells("B{$line}:G{$line}");


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


        $line++;        

            foreach ($companyName as $i => $cName) {
                    $sheet->setCellValue("A{$line}", $i);
                    $sheet->setCellValue("B{$line}", $cName->name);
                    $sheet->setCellValue("C{$line}", $cName->unical_code);
                    
                    $new_arrayUZS = $summaUZS[$cName->unical_code] ? $summaUZS[$cName->unical_code] : []; 
                    $sheet->setCellValue("D{$line}", array_sum($new_arrayUZS));
                    $sum_new_arrayUZS += array_sum($new_arrayUZS);

                    $new_arrayUSD = $summaUSD[$cName->unical_code] ? $summaUSD[$cName->unical_code] : []; 
                    $sheet->setCellValue("E{$line}", array_sum($new_arrayUSD));
                    $sum_new_arrayUSD += array_sum($new_arrayUSD);

                    $new_arrayEUR = $summaEUR[$cName->unical_code] ? $summaEUR[$cName->unical_code] : []; 
                    $sheet->setCellValue("F{$line}", array_sum($new_arrayEUR));
                    $sum_new_arrayEUR += array_sum($new_arrayEUR);    

                    $new_arrayRUB = $summaRUB[$cName->unical_code] ? $summaRUB[$cName->unical_code] : []; 
                    $sheet->setCellValue("F{$line}", array_sum($new_arrayRUB));
                    $sum_new_arrayRUB += array_sum($new_arrayRUB);                                      

                    $line++;
            }

        $sheet->setCellValue("D{$line}", $dk20208);

        $line++;
        $sheet->setCellValue("A{$line}", '');
        $sheet->setCellValue("B{$line}", 'Итого');
        $sheet->setCellValue("C{$line}", '');
        $sheet->setCellValue("D{$line}", round($sum_new_arrayUZS, 2));
        $sheet->setCellValue("E{$line}", round($sum_new_arrayUSD, 2));
        $sheet->setCellValue("F{$line}", round($sum_new_arrayEUR, 2));
        $sheet->setCellValue("G{$line}", round($sum_new_arrayRUB, 2));
        $sheet->setCellValue("H{$line}", '0');
        $sheet->setCellValue("I{$line}", '0');
        $sheet->setCellValue("J{$line}", '0');
        $sheet->setCellValue("K{$line}", '0');
        $sheet->setCellValue("L{$line}", '0');
        $sheet->setCellValue("M{$line}", '0');
        $sheet->setCellValue("N{$line}", '0');
        $sheet->setCellValue("O{$line}", '0');
        $sheet->setCellValue("P{$line}", '0');
        $sheet->setCellValue("Q{$line}", '0');
        $sheet->setCellValue("R{$line}", '0');
        $sheet->setCellValue("S{$line}", '0');



        // Далее в цикле выводим товары.
        //    $fileinfo = FileInfo::find()->indexBy('id')->all();

        //    foreach ($fileinfo as $i => $info){
        //        $line++;
        //        $bankName = BankBranch::find()->where(['mfo' => $info['bank_mfo']])->one();
        //        $getDetailData = Document::find()->where(['file_id' => $info['id']])->all();
        //        $line++;
        //        $sheet->setCellValue("A{$line}", $bankName->short_name);
        //        $sheet->setCellValue("B{$line}", $info['bank_mfo']);

        //        foreach ($getDetailData as $j => $getDD) {
        //            $companyName = Company::find()->where(['inn' => $getDD->detail_inn])->one();
        //            $sheet->setCellValue("C{$line}", $companyName->name);
        //            $sheet->setCellValue("D{$line}", $getDD->detail_inn);
        //            $sheet->setCellValue("E{$line}", $getDD->detail_account);


        //            $sheet->setCellValue("F{$line}", $getDD->detail_date);
        //            $sheet->setCellValue("G{$line}", $info['data_period']);
        //            $sheet->setCellValue("H{$line}", '01.01.2020');
        //            $sheet->setCellValue("I{$line}", '31.12.2020');
        //            $sheet->setCellValue("J{$line}", 'Хамкор корхона номи');
        //            $sheet->setCellValue("K{$line}", 'Хамкор корхона х/р');
        //            $sheet->setCellValue("L{$line}", $getDD->detail_document_number);
        //            $sheet->setCellValue("M{$line}", $getDD->detail_debet);
        //            $sheet->setCellValue("N{$line}", $getDD->detail_kredit);
        //            $sheet->setCellValue("O{$line}", $getDD->detail_purpose_of_payment);
        //            $sheet->setCellValue("P{$line}", $getDD->code_currency);
        //            $sheet->setCellValue("Q{$line}", 'Контракт рақами');
        //            $sheet->setCellValue("R{$line}", $getDD->contract_date);
        //            $line++;
        //        }
        //    }


        //Файл готов
        //Отдаем его браузеру на скачивание
        header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        $date = date('d.m.Y H:m:s');
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=order (".$date.").xlsx");

        $objWriter = new \PHPExcel_Writer_Excel2007($xls);
        $objWriter->save('php://output');


        // Или сохраняем на сервере
        $objWriter = new \PHPExcel_Writer_Excel2007($xls);
        $objWriter->save('downloads/order( ' . $date . ').xlsx');


        return $this->render('to-excel');
    }


}

