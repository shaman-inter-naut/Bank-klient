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
            $detail_counter=0;
            $eee = [];
            $results = [];
            $res = [];
            while ($s = fgets($fp)) {

                if ($getTemplate->template == 1){
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
                    if(strpos($fields,"Дата   |")){
                        $details=true;
                        $position++;
                    }
                    if($details) $position++;
                    if($details & $position>3) {
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
                }
//***********************************************************Read from text file********************************************************
                else     if ($getTemplate->template == 2){
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
                    if(strpos($s,"Корреспондент:")){
                        $details=true;
                        $position++;
                    }
                    if($details) $position++;
                    if($details & $position>3) {
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
                }
//*******************************************************************************************************************
                else     if ($getTemplate->template == 3){
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
                    if(strpos($s,"КОРРЕСПОНДЕНТ:")){
                        $details=true;
                        $position++;
                    }
                    if($details) $position++;
                    if($details & $position>4) {
                        $rrr = explode("│", $s);

                        if (count($rrr) == 1) {
                            $detail_counter=1;
                        }

                        if (count($rrr) == 8) {
                            if($detail_counter==1){
                                $detail_counter++;
                                $needed_detail++;
                                $eee[$needed_detail] = $rrr;
                            }
                            else {
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
            if ($getTemplate->template == 1){
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
                    $model->file_name = $filePath;
                    $model->file_date = $date;
                    $model->data_period = $interval;
                    $model->depozitBefore = $beginDeposit;
                    $endDeposit = trim(str_replace(",", "", $endDeposit));
                    $model->depozitAfter = $endDeposit;
                    $model->save(false);
                    $lastID = Yii::$app->db->getLastInsertID();


                foreach ($eee as $key =>$value)
                {
                    $debet = trim(str_replace(",", "", $value[5]));
                    $kredit = trim(str_replace(",", "", $value[6]));

                    $document = Document::find()->where(
                        [
                            'detail_date' => $value[0],
                            'detail_document_number'=> $value[2],
                            'detail_purpose_of_payment' => $value[7],
                            'detail_debet' => $debet,
                            'detail_kredit' => $kredit,
                        ])->all();
                    if(!$document) {
                        $document = new Document();
                        $document->file_id = $lastID;
                        $document->detail_date = $value[0];
                        preg_match('/(?P<acc>\d+)\s+(?P<name1>\D+)\s+(?P<inn>\d+)/', $value[1], $matches);
                        $document->detail_account = $matches['acc'];
                        $document->detail_inn = $matches['inn'];
                        $document->detail_name ='-';// $eee[1];
                        $document->detail_document_number = $value[2];
                        $document->detail_mfo =$value[4];
                        $document->detail_debet = $debet;
                        $document->detail_kredit = $kredit;
                        $document->detail_purpose_of_payment = $value[7];
                        $document->code_currency = substr($matches['acc'], 5, 3);
                        $document->contract_date = '-';
                        $document->save(false);
                    }else if ($document){
                        session_start();
                        $_SESSION['file_date'] = $value[0];
                        $_SESSION['detail_document_number'] = $value[2];
                        $_SESSION['detail_purpose_of_payment'] = $value[4];
                        $_SESSION['detail_debet'] = $debet;
                        $_SESSION['detail_kredit'] = $kredit;
                        $s = 'Refresh:0; url=http://bank-klient/file-info/view?id='.$lastID;
                        header($s);
//                            exit;
                    }
                }
                /* END Fayl import qilish va ma`lumotlarni bazaga saqlash */

            }
//*******************************************************************************************************************
            else if ($getTemplate->template == 2){
                $mfo = trim(str_replace("-", "", $results['mfo']));
                $acc = trim(str_replace("Счет:", "", $results['acc']));
                $date = trim(str_replace("Изг", "", $results['date']));
                $interval1 = trim(str_replace("СЧЕТА за", "", $results['interval1']));
                $interval2 = trim(str_replace("посл.проводки :", "", $results['interval2']));
                $interval = $interval1.' - '.$interval2;
                $beginDeposit = trim(str_replace("Начало дня Пассив", "", $results['beginDeposit']));
                $beginDeposit = trim(str_replace(",", "", $beginDeposit));
                $endDeposit = trim(str_replace("Конец дня Пассив", "", $results['endDeposit']));

                    $model->bank_id = $_POST['FileInfo']['bank_id'];
                    $model->bank_mfo = $mfo;
                    $model->company_account = $acc;
                    $unikal = substr($acc, 10, 7);
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
//                }

                foreach ($eee as $key =>$value)
                {
                        $pat = array(
                            "mfo" => "((МФО:)\d{5})",     //mfo
                            "acc" => "((Счет:)\d{20})",   //acc
                            "inn" => "((ИНН:)\d{9})",     //inn
                            "contract_date" => "((от )\d{1,2}\.\d{1,2}\.\d{4})",     //inn
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
                                'detail_document_number'=> $value[2],
                                'detail_purpose_of_payment' => $value[4],
                                'detail_debet' => $debet,
                                'detail_kredit' => $kredit,
                            ])->all();
                        if(!$document) {
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

                            $document->save(false);
                    }else if ($document){
                            session_start();
                            $_SESSION['file_date'] = $value[0];
                            $_SESSION['detail_document_number'] = $value[2];
                            $_SESSION['detail_purpose_of_payment'] = $value[4];
                            $_SESSION['detail_debet'] = $debet;
                            $_SESSION['detail_kredit'] = $kredit;
                            $s = 'Refresh:0; url=http://bank-klient/file-info/view?id='.$lastID;
                            header($s);
//                            exit;
                        }
                }
            }
//*******************************************************************************************************************
            else  if ($getTemplate->template == 3){
                $acc = trim(str_replace("Лицевой счет №", "", $results['acc']));
                $inn = trim(str_replace("ИНН:", "", $results['inn']));
                $date = trim(str_replace("Входящий остаток на", "", $results['date']));
                $interval1 = trim(str_replace("Выписка с", "", $results['interval1']));
                $interval2 = trim(str_replace("по", "", $results['interval2']));
                $interval = $interval1.' - '.$interval2;

                $model->bank_id = $_POST['FileInfo']['bank_id'];
                $model->bank_mfo = '00014';
                $model->company_account = $acc;
                $model->company_inn = $inn;
                $model->file_name = $filePath;
                $model->file_date = $date;
                $model->data_period = $interval;
                $model->save(false);
                $lastID = Yii::$app->db->getLastInsertID();

                foreach ($eee as $key =>$value)
                {
                    $pat = array(
                        "mfo" => "((МФО:)\d{5})",   //mfo
                        "acc" => "((Счет:)\d{20})",   //mfo
                        "inn" => "((ИНН:)\d{9})",   //mfo
                    );

                    foreach ($pat as $key => $p) {
                        preg_match($p, $value[4], $m, PREG_OFFSET_CAPTURE, 0);
                        if ($m) {
                            $res[$key] = $m[0][0];
                        }
                    }

                    $document=new Document();
                    $document->file_id = $lastID;
                    $patt = array(
                        "date" => "(\d{1,2}\.\d{1,2}\.\d{4})",   //mfo
                    );

                    foreach ($patt as $kk => $pp) {
                        preg_match($pp, $value[1], $mm, PREG_OFFSET_CAPTURE, 0);
                        if ($mm) {
                            $ress[$kk] = $mm[0][0];
                        }
                    }
                    $document->detail_date = trim($ress['date']);
                    $document->detail_document_number = $value[2];
                    $document->detail_inn = trim(str_replace("ИНН:", "", $res['inn']));
                    $document->detail_account = trim(str_replace("Счет:", "", $res['acc']));
                    $document->detail_name ='-';
                    $document->detail_mfo = trim(str_replace("МФО:", "", $res['mfo']));
                    $debet = trim(str_replace(",", "", $value[5]));
//                                $debet = trim(str_replace(".", ",", $debet));
                    $document->detail_debet = $debet;
                    $kredit = trim(str_replace(",", "", $value[6]));
//                                $kredit = trim(str_replace(".", ",", $kredit));
                    $document->detail_kredit = $kredit;
                    $document->detail_purpose_of_payment =$value[4];
                    $document->code_currency = substr(trim(str_replace("Счет:", "", $res['acc'])), 5, 3);

//                                $patte = array(
//                                    "date" => "((от\s+)\d{1,2}\.\d{1,2}\.\d{4})",   //mfo
//                                );
//
//                                foreach ($patte as $keyy => $pt) {
//                                    preg_match($pt, $value[4], $mat, PREG_OFFSET_CAPTURE, 0);
//                                    if ($mat) {
//                                        $re[$keyy] = $mat[0][0];
//                                    }
//                                }
//                                $document->contract_date = trim(str_replace("от", "", $re['date']));

                    $document->contract_date = '-';
                    $document->save(false);
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

//        if ($model->load(Yii::$app->request->post()) ) {
//        composer require phpoffice/phpexcel
//        require_once __DIR__ . '/PHPExcel/Classes/PHPExcel.php';
//        require_once __DIR__ . '/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
        require_once(Yii::getAlias('@vendor/phpoffice/phpexcel/Classes/PHPExcel.php'));

        //Создаем экземпляр класса PHPExcel.
        $xls = new \PHPExcel();

        // Писать будем в первый лист.
        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();

        // Ширина задается в количестве символов.
        $sheet->getColumnDimension('A')->setWidth(55);//bank номи
        $sheet->getColumnDimension('B')->setWidth(15);//bank MFO
        $sheet->getColumnDimension('C')->setWidth(35);//Korxona nomi
        $sheet->getColumnDimension('D')->setWidth(20);//Korxona INN
        $sheet->getColumnDimension('E')->setWidth(25);//Korxona X/R
        $sheet->getColumnDimension('F')->setWidth(20);//Dokument sanasi
        $sheet->getColumnDimension('G')->setWidth(40);//Oraliq davr
        $sheet->getColumnDimension('H')->setWidth(20);//Бошланғич депозит
        $sheet->getColumnDimension('I')->setWidth(20);//Якуний депозит
        $sheet->getColumnDimension('J')->setWidth(30);//Xamkor korxona nomi
        $sheet->getColumnDimension('K')->setWidth(25);//Xamkor korxona X/R
        $sheet->getColumnDimension('L')->setWidth(20);//Provodka sanasi
        $sheet->getColumnDimension('M')->setWidth(20);//Debet
        $sheet->getColumnDimension('N')->setWidth(20);//Kredit
        $sheet->getColumnDimension('O')->setWidth(50);//Тўлов мақсади
        $sheet->getColumnDimension('P')->setWidth(15);//Valyuta kodi
        $sheet->getColumnDimension('Q')->setWidth(20);//Шартнома рақами
        $sheet->getColumnDimension('R')->setWidth(20);//Шартнома санаси
//            $sheet->getColumnDimension('Q')->setWidth(10);//

        //        Для удобства заводим переменную $line, в ней будем считать номер строки.
        $line = 1;
        $sheet->setCellValue("A{$line}", 'Корхонанинг банк хисоб рақамлари орқали кирим-чиқим хисоботлари № 1 от ' . date('d.m.Y H:i'));

        //        Объединяем ячейки по горизонтали.
        $sheet->mergeCells("A{$line}:G{$line}");


        //Делаем выравнивание по центру вертикали и горизонтали.
//        $sheet->getStyle("A{$line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//        $sheet->getStyle("A{$line}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        //Делаем текст жирным и увеличиваем шрифт.
        $sheet->getStyle("A{$line}")->getFont()->setBold(true);
        $sheet->getStyle("A{$line}")->getFont()->setSize(14);

        // Пропускаем строку после заголовка.
        $line++;
        $sheet->setCellValue("A{$line}", '');
        $sheet->mergeCells("A{$line}:P{$line}");

        //Информация о поставщике
        $line++;
        $sheet->setCellValue("A{$line}", 'Банк номи:');
        $sheet->setCellValue("B{$line}", 'Банк МФО');
        $sheet->setCellValue("C{$line}", 'Корхона номи');
        $sheet->setCellValue("D{$line}", 'Корхона ИНН');
        $sheet->setCellValue("E{$line}", 'Корхона Х/Р');
        $sheet->setCellValue("F{$line}", 'Документ санаси');
        $sheet->setCellValue("G{$line}", 'Оралиқ давр');
        $sheet->setCellValue("H{$line}", 'Бошланғич депозит');
        $sheet->setCellValue("I{$line}", 'Якуний депозит');
        $sheet->setCellValue("J{$line}", 'Хамкор корхона номи');
        $sheet->setCellValue("K{$line}", 'Хамкор корхона х/р');
        $sheet->setCellValue("L{$line}", 'Документ рақами');
        $sheet->setCellValue("M{$line}", 'Дебет');
        $sheet->setCellValue("N{$line}", 'Кредит');
        $sheet->setCellValue("O{$line}", 'Тўлов мақсади');
        $sheet->setCellValue("P{$line}", 'Валюта коди');
        $sheet->setCellValue("Q{$line}", 'Шартнома рақами');
        $sheet->setCellValue("R{$line}", 'Шартнома санаси');

        $sheet->getStyle("A{$line}")->getFont()->setBold(true);
        $sheet->getStyle("B{$line}")->getFont()->setBold(true);
        $sheet->getStyle("C{$line}")->getFont()->setBold(true);
        $sheet->getStyle("D{$line}")->getFont()->setBold(true);
        $sheet->getStyle("E{$line}")->getFont()->setBold(true);
        $sheet->getStyle("F{$line}")->getFont()->setBold(true);
        $sheet->getStyle("G{$line}")->getFont()->setBold(true);
        $sheet->getStyle("H{$line}")->getFont()->setBold(true);
        $sheet->getStyle("I{$line}")->getFont()->setBold(true);
        $sheet->getStyle("J{$line}")->getFont()->setBold(true);
        $sheet->getStyle("K{$line}")->getFont()->setBold(true);
        $sheet->getStyle("L{$line}")->getFont()->setBold(true);
        $sheet->getStyle("M{$line}")->getFont()->setBold(true);
        $sheet->getStyle("N{$line}")->getFont()->setBold(true);
        $sheet->getStyle("O{$line}")->getFont()->setBold(true);
        $sheet->getStyle("P{$line}")->getFont()->setBold(true);
        $sheet->getStyle("Q{$line}")->getFont()->setBold(true);
        $sheet->getStyle("R{$line}")->getFont()->setBold(true);
        //  $sheet->mergeCells("B{$line}:G{$line}");



        // Далее в цикле выводим товары.
        $fileinfo = FileInfo::find()->indexBy('id')->all();

        foreach ($fileinfo as $i => $info){
            $line++;
            $bankName = BankBranch::find()->where(['mfo' => $info['bank_mfo']])->one();
            $getDetailData = Document::find()->where(['file_id' => $info['id']])->all();
            $line++;
            $sheet->setCellValue("A{$line}", $bankName->short_name);
            $sheet->setCellValue("B{$line}", $info['bank_mfo']);

            foreach ($getDetailData as $j => $getDD) {
                $companyName = Company::find()->where(['inn' => $getDD->detail_inn])->one();
                $sheet->setCellValue("C{$line}", $companyName->name);
                $sheet->setCellValue("D{$line}", $getDD->detail_inn);
                $sheet->setCellValue("E{$line}", $getDD->detail_account);


                $sheet->setCellValue("F{$line}", $getDD->detail_date);
                $sheet->setCellValue("G{$line}", $info['data_period']);
                $sheet->setCellValue("H{$line}", '01.01.2020');
                $sheet->setCellValue("I{$line}", '31.12.2020');
                $sheet->setCellValue("J{$line}", 'Хамкор корхона номи');
                $sheet->setCellValue("K{$line}", 'Хамкор корхона х/р');
                $sheet->setCellValue("L{$line}", $getDD->detail_document_number);
                $sheet->setCellValue("M{$line}", $getDD->detail_debet);
                $sheet->setCellValue("N{$line}", $getDD->detail_kredit);
                $sheet->setCellValue("O{$line}", $getDD->detail_purpose_of_payment);
                $sheet->setCellValue("P{$line}", $getDD->code_currency);
                $sheet->setCellValue("Q{$line}", 'Контракт рақами');
                $sheet->setCellValue("R{$line}", $getDD->contract_date);
                $line++;
            }
        }


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

