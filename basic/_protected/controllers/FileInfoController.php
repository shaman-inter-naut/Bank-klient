<?php

namespace app\controllers;

use app\models\AccountNumber;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use app\models\BankBranch;
use app\models\Company;
use app\models\Document;
use app\models\Bank;
use Yii;
use app\models\FileInfo;
use app\models\FileInfoSearch;
use yii\helpers\Url;
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
                            "toMFO" => "((ЖИЗЗАХ Ш.,\s+)\D+)",   // inn
                            "date" => "((Входящий остаток на\s+)\d{1,2}\.\d{1,2}\.\d{4})",         // date
                            "interval1" => "((\s+Выписка с\s+)\d{1,2}\.\d{1,2}\.\d{4})",         // date
                            "interval2" => "((\s+по\s+)\d{1,2}\.\d{1,2}\.\d{4})",         // date
                            "toMFO" => '(/ТИФ МИЛЛИЙ БАНКИ/)'         // toMFO
                        );
                        foreach ($patterns as $key => $pattern) {
                            preg_match($pattern, $s, $matches, PREG_OFFSET_CAPTURE, 0);
                            if ($matches) {
                                $results[$key] = $matches[0][0];
                            }
                        }


                        
                        

//
//
//                        echo "<pre>";
//                            print_r($results);
//                        echo "<pre>";

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
//                    if ($details & $position > 10) {
//                        //$text = 'ЖИЗЗАХ Ш., "ТИФ МИЛЛИЙ БАНКИ" АЖ ЖИЗЗАХ ВИЛОЯТИ ФИЛИАЛИ';
//                        $regexp = '/ТИФ МИЛЛИЙ БАНКИ/';
//                        $result = preg_match($regexp, $s, $match);
//                        var_dump(
//                            $result,
//                            $match
//                        );
//                        if (strpos($s, "ТИФ МИЛЛИЙ БАНКИ"))
//                            echo "Positsiya: ".(strpos($s, "ТИФ МИЛЛИЙ БАНКИ"));
//                    }
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

                $mfoTest = BankBranch::find()->where(['mfo' => $mfo])->one();
                $innTest = Company::find()->where(['inn' => $inn])->one();
                $mainTest = AccountNumber::find()->where(['account_number' => $main])->one();

                if (isset($mainTest)) {
                //******************************* begin save to db ********************
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
                    $model->description = $detail_counter;
                    $model->save(false);
                    $lastID = Yii::$app->db->getLastInsertID();

                    $countDetailToRecord= 0;
                    $countDetailNoRecord = 0;

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
                        $date = date_format(date_create($value[0]), 'Y-m-d H:i:s');

                        $document = Document::find()->where(
                            [
                                'detail_date' => $date,
                                'detail_document_number' => $value[2],
                                'detail_purpose_of_payment' => $value[7],
                                'detail_debet' => $debet,
                                'detail_kredit' => $kredit,
                            ])->all();


                        if (!$document) {
                            $countDetailToRecord ++;
                            $document = new Document();
                            $document->file_id = $lastID;
                            $document->detail_date = $date;
                            preg_match('/(?P<acc>\d+)\s+(?P<name1>\D+)\s+(?P<inn>\d+)/', $value[1], $matches);
                            $document->detail_account = $matches['acc'];
                            $document->detail_inn = $matches['inn'];
                            $document->detail_document_number = $value[2];
                            $unikalCode = substr($matches['acc'], 9, 8);
                            $company = Company::find()->where(['unical_code' => $unikalCode])->one();
                            $document->detail_name = htmlspecialchars($company->name, ENT_NOQUOTES);
                            $document->detail_mfo = $value[4];
                            $document->detail_debet = $debet;
                            $document->detail_kredit = $kredit;
                            $document->detail_purpose_of_payment = $value[7];
                            $document->code_currency = substr($matches['acc'], 5, 3);
                            $document->contract_date = $contract_date;
                            $document->company_unikal = substr($main, 9, 8);

                            $document->save(false);
                        }
                        else if ($document) {
                            $countDetailNoRecord++;
//                            session_start();
//                            $_SESSION['file_date'] = $value[0];
//                            $_SESSION['detail_document_number'] = $value[2];
//                            $_SESSION['detail_purpose_of_payment'] = $value[4];
//                            $_SESSION['detail_debet'] = $debet;
//                            $_SESSION['detail_kredit'] = $kredit;
//                            $s = 'Refresh:0; url=http://bank-klient/file-info/view?id=' . $lastID;
//                            header($s);
                        }
                    }

                    $model->countDetailToRecord = $countDetailToRecord;
                    $model->countDetailNoRecord = $countDetailNoRecord;
                    $model->save(false);

  //                  echo "To: ".$countDetailToRecord;
  //                  echo "No: ".$countDetailNoRecord;


                //******************************* end save to db **********************
                }else{
                    $s = 'Refresh:15; url='.Url::home(true).'file-info/index';
                    header($s);
                    echo '<div style="border: 0px solid gray; border-radius: 2px; background-color: silver; margin: 50px; padding: 30px; box-shadow: 5px 5px 20px;">';
                    echo '<b><h3 style="text-align: center; color:red;">Ушбу корхонанинг реквизитлари МБ га киритилмаганлиги сабабли дастур томонидан қабул қилинмади: </h3></b><br><br>';
                    echo 'Банк МФО: <b>'.$mfoTest.'</b><br><br>';
                    echo 'Корхона номи: <b>'.$innTest->name.'</b><br><br>';
                    echo 'Корхона ИНН: <b>'.$innTest->inn.'</b><br><br>';
                    echo 'Уникаль коди: <b>'.$innTest->unical_code.'</b><br><br><br>';
                    echo '<h3>Корхонанинг реквизитларини киритиш учун <a href="'.Url::home(true).'company/info" ><b> "Корхона ва хисоб рақамлар"</b> сахифасига ўтиш</a></h3><br>';
                    echo "</div>";
                    exit;
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

                $mfoTest = BankBranch::find()->where(['mfo' => $mfo])->one();
                $unikalTest = substr($acc, 9, 8);
                $companyTest = Company::find()->where(['unical_code' => $unikalTest])->one();
//                echo $companyTest->inn."<br>";
//                echo $companyTest->name."<br>";
//                echo $companyTest->unical_code."<br>";
//                echo $acc;
                $accTest = AccountNumber::find()->where(['account_number' => $acc])->one();

//                print_r($accTest);

                if (isset($accTest)) {
                    //******************************* begin save to db ********************
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
                        $date = date_format(date_create($value[1]), 'Y-m-d H:i:s');

                        $document = Document::find()->where(
                            [
                                'detail_date' => $date,
                                'detail_document_number' => $value[2],
                                'detail_purpose_of_payment' => $value[4],
                                'detail_debet' => $debet,
                                'detail_kredit' => $kredit,
                            ])->all();
                        if (!$document) {
                            $document = new Document();
                            $document->file_id = $lastID;
                            $document->detail_date = $date;
                            $document->detail_document_number = $value[2];
                            $document->detail_inn = $inn;
                            $document->detail_account = $account;
//                            echo $account;
                            $unikalCode = substr($account, 9, 8);
                            $company = Company::find()->where(['unical_code' => $unikalCode])->one();
//                            echo $company->name;
                            $document->detail_name = htmlspecialchars($company->name, ENT_NOQUOTES);
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
                            $s = 'Refresh:0; url='.Url::home(true).'file-info/view?id=' . $lastID;
                            header($s);
                        }
                    }
                    //******************************* end save to db ********************
                    echo $mainTest->account_number;
                }else{
                    $s = 'Refresh:15; url='.Url::home(true).'file-info/index';
                    header($s);
                    echo '<div style="border: 0px solid gray; border-radius: 2px; background-color: silver; margin: 50px; padding: 30px; box-shadow: 5px 5px 20px;">';
                    echo '<b><h3 style="text-align: center; color:red;">Ушбу корхонанинг реквизитлари МБ га киритилмаганлиги сабабли дастур томонидан қабул қилинмади: </h3></b><br><br>';
                    echo 'Банк МФО: <b>'.$mfoTest->mfo.'</b><br><br>';
                    echo 'Корхона номи: <b>'.$companyTest->name.'</b><br><br>';
                    echo 'Корхона ИНН: <b>'.$companyTest->inn.'</b><br><br>';
                    echo 'Уникаль коди: <b>'.$unikalTest.'</b><br><br><br>';
                    echo '<h3>Корхонанинг реквизитларини киритиш учун <a href="'.Url::home(true).'company/info" ><b> "Корхона ва хисоб рақамлар"</b> сахифасига ўтиш</a></h3><br>';
                    echo "</div>";
                    exit;
                }




            } //*******************************************************************************************************************
            else if ($getTemplate->template == 3) {
                $acc = trim(str_replace("Лицевой счет №", "", $results['acc']));
                $inn = trim(str_replace("ИНН:", "", $results['inn']));
                $date = trim(str_replace("Входящий остаток на", "", $results['date']));
                $interval1 = trim(str_replace("Выписка с", "", $results['interval1']));
                $interval2 = trim(str_replace("по", "", $results['interval2']));
                $interval = $interval1 . ' - ' . $interval2;
                $toMFO =
                   // ТИФ МИЛЛИЙ БАНКИ

//                $mfoTest = BankBranch::find()->where(['mfo' => $mfo])->one();
                $mfoTest = "00014";
                $innTest = Company::find()->where(['inn' => $inn])->one();
//                echo $innTest->inn."<br>";
//                echo $innTest->name."<br>";
//                echo $innTest->unical_code."<br>";
//                echo $acc;
                $mainTest = AccountNumber::find()->where(['account_number' => $acc])->one();
                if (isset($mainTest)) {
                    echo $mainTest->account_number;
                }else{
                    $s = 'Refresh:15; url='.Url::home(true).'file-info/index';
                    header($s);
                    echo '<div style="border: 0px solid gray; border-radius: 2px; background-color: silver; margin: 50px; padding: 30px; box-shadow: 5px 5px 20px;">';
                    echo '<b><h3 style="text-align: center; color:red;">Ушбу корхонанинг реквизитлари МБ га киритилмаганлиги сабабли дастур томонидан қабул қилинмади: </h3></b><br><br>';
                    echo 'Банк МФО: <b>'.$mfoTest.'</b><br><br>';
                    echo 'Корхона номи: <b>'.$innTest->name.'</b><br><br>';
                    echo 'Корхона ИНН: <b>'.$innTest->inn.'</b><br><br>';
                    echo 'Уникаль коди: <b>'.$innTest->unical_code.'</b><br><br><br>';
                    echo '<h3>Корхонанинг реквизитларини киритиш учун <a href="'.Url::home(true).'company/info" ><b> "Корхона ва хисоб рақамлар"</b> сахифасига ўтиш</a></h3><br>';
                    echo "</div>";
                    exit;
                }


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
                    $date = date_format(date_create($value[1]), 'Y-m-d H:i:s');

                    $document = Document::find()->where(
                        [
                            'detail_date' => $date,
                            'detail_document_number' => $value[2],
                            'detail_purpose_of_payment' => $value[4],
                            'detail_debet' => $debet,
                            'detail_kredit' => $kredit,
                        ])->all();
                    if (!$document) {
                        $document = new Document();
                        $document->file_id = $lastID;
                        $document->detail_date = $date;
                        $document->detail_document_number = $value[2];
                        $document->detail_inn = trim(str_replace("ИНН:", "", $res['inn']));
                        $detail_account = trim(str_replace("Счет:", "", $res['acc']));
                        $document->detail_account = $detail_account;
                        $unikalCode = substr($detail_account, 9, 8);
                        $company = Company::find()->where(['unical_code' => $unikalCode])->one();
                        $document->detail_name = htmlspecialchars($company->name, ENT_NOQUOTES);
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




    public function actionToHtmlTable(){

        $companyName = Company::find()->limit(23)->all();

        $massiv = [
            $n = ['20208000', '20210000', '20214000'],
            $nUSD = ['20208840', '20210840', '20214840'],
            $nEUR = ['20208978', '20210978', '20214978'],
            $nRUB = ['20208643', '20210643', '20214643'],
            $nAkkrUZS = ['22602000'],
            $nAkkrEUR = ['22602840'],
            $nAkkrRUB = ['22602978'],
            $nBlokUZS = ['22613000'],
            $nBlokUSD = ['22613840'],
            $nBlokEUR = ['22613978'],
            $nBlokRUB = ['22613643'],
            $nDepUZS = ['20614000'],
            $nDepUSD = ['20614840'],
            $nDepEUR = ['20614978'],
            $nDepRUB = ['20614643'],
            $nKorpKarta = ['22620'],
        ];

        foreach ($massiv as $key_massiv => $value_massiv){
//            print_r($value_massiv);
            foreach ($value_massiv as $key_n => $value_n) {
//                print_r($key_massiv." | ".$value_n."<br>");
                $file = FileInfo::find()->where(['like', 'company_account', $value_n])->all();
//                print_r( $file);
                foreach ($file as $key_file => $value_file) {
                    $accounts = AccountNumber::find()->where(['like', 'account_number', $value_file->company_account])->all();
                    $acc = $accounts[0]['stock'];
                    $value_file->depozitBefore = $value_file->depozitBefore ? $value_file->depozitBefore : 0;
//                    print_r( $value_file);
                    $company_unikal = substr($value_file->company_account, 9, 8);
//                    print_r($company_unikal);
                    $document = Document::find()->where(['file_id' => $value_file->id])->all();
//                    print_r($document);
                    foreach ($document as $k => $val) {
//                        print_r($val);
                        $val->detail_kredit = $val->detail_kredit ? $val->detail_kredit : 0;
                        $val->detail_debet = $val->detail_debet ? $val->detail_debet : 0;
                        $summa[$company_unikal]['kredit'][$key_massiv][$value_n] += $val->detail_kredit;
                        $summa[$company_unikal]['debet'][$key_massiv][$value_n] += $val->detail_debet;
                        $summa[$company_unikal]['bosh'][$key_massiv][$value_n] = $accounts[0]['stock'];
                    }
                }
            }
        }





//        print_r($bosh); exit;


//        foreach ($companyName as $i => $cName) {
//            $new_array = $summa[$cName->unical_code] ? $summa[$cName->unical_code] : [];
//            print_r(array_sum($new_array));
//            echo "<hr>";
//            $sum_new_array += array_sum($new_array);
//        }
//        print_r($sum_new_array."<br>");








        return $this->render('to-html-table', [
            'companyName' => $companyName,
            'nUZS' => $nUZS,
            'summa' => $summa
        ]);
    }

}