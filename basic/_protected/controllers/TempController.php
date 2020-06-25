<?php

namespace app\controllers;

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

//        $lastID = $id;
        $lastInserted = FileInfo::find()->where(['id' => $id])->one();
        $getCompanyINN = Company::find()->where(['inn' => $lastInserted->company_inn])->one();

//        echo $lastInserted->file_inn.'<br>';
//        echo $getCompanyINN->name;

        $get_company_name = $getCompanyINN->name;
//        $lastInserted->save(false);


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
                            "date" => "(Изг:\d{1,2}\.\d{1,2}\.\d{4})",         // date
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
                            "interval2" => "((посл.проводки :)\d{1,2}\.\d{1,2}\.\d{4})"         // date
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
                            if (strlen(trim($rrr[1])) == 10) {
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
                $interval = trim(str_replace("Сведения о работе счета c ", "", $results['interval']));
                $interval = str_replace(" по ", " - ", $interval);

                $model->bank_id = $_POST['FileInfo']['bank_id'];
                $model->bank_mfo = $mfo;
                $model->company_account = $main;
                $model->company_inn = $inn;
                $model->file_name = $filePath;
                $model->file_date = $date;
                $model->data_period = $interval;
                $model->save(false);
                $lastID = Yii::$app->db->getLastInsertID();


                foreach ($eee as $key =>$value)
                {
                    $document = new Document();
                    $document->file_id = $lastID;
                    $patt = array(
                        "date" => "(\d{1,2}\.\d{1,2}\.\d{4})",   //mfo
                    );

                    foreach ($patt as $kk => $pp) {
                        preg_match($pp, $value[0], $mm, PREG_OFFSET_CAPTURE, 0);
                        if ($mm) {
                            $ress[$kk] = $mm[0][0];
                        }
                    }
                    $document->detail_date = trim($ress['date']);

                    preg_match('/(?P<acc>\d+)\s+(?P<name1>\D+)\s+(?P<inn>\d+)/', $value[1], $matches);

                    $document->detail_account = $matches['acc'];
                    $document->detail_inn = $matches['inn'];
                    $document->detail_name ='-';// $eee[1];
                    $document->detail_document_number = $value[2];
                    $document->detail_mfo =$value[4];
                    $debet = trim(str_replace(",", "", $value[5]));
                    $debet = trim(str_replace(".", ",", $debet));
                    $document->detail_debet = $debet;
                    $kredit = trim(str_replace(",", "", $value[6]));
                    $kredit = trim(str_replace(".", ",", $kredit));
                    $document->detail_kredit = $kredit;
                    $document->detail_purpose_of_payment =$value[7];
                    $document->code_currency = '-';
                    $document->contract_date = '-';
                    $document->save(false);
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

                $model->bank_id = $_POST['FileInfo']['bank_id'];
                $model->bank_mfo = $mfo;
                $model->company_account = $acc;
                $unikal = substr($acc, 10, 7);
                $company = Company::find()->where(['unical_code' => $unikal])->one();
                $model->company_inn = $company->inn;
                $model->file_name = $filePath;
                $model->file_date = $date;
                $model->data_period = $interval;
                $model->save(false);
                $lastID = Yii::$app->db->getLastInsertID();

                foreach ($eee as $key =>$value)
                {
                    $pat = array(
                        "mfo" => "(\d{5})",   //mfo
                        "acc" => "(\d{20})",   //mfo
                        "inn" => "(\d{9})",   //mfo
                    );
                    foreach ($pat as $k => $p) {
                        preg_match($p, $value[4], $m, PREG_OFFSET_CAPTURE, 0);
                        if ($m) {
                            $res[$k] = $m[0][0];
                        }
                    }
//                        echo "<pre>";
//                        print_r($res);
//                        echo "</pre>";

                    $document = new Document();
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
                    $document->detail_date = $ress['date'];
                    $document->detail_document_number = $value[2];
                    $document->detail_inn = $res['inn'];
                    $document->detail_account = $res['acc'];
                    $document->detail_name ='-';
                    $document->detail_mfo = $res['mfo'];
                    $debet = trim(str_replace(",", "", $value[5]));
                    $debet = trim(str_replace(".", ",", $debet));
                    $document->detail_debet = $debet;
                    $kredit = trim(str_replace(",", "", $value[6]));
                    $kredit = trim(str_replace(".", ",", $kredit));
                    $document->detail_kredit = $kredit;
                    $document->detail_purpose_of_payment =$value[4];
                    $document->code_currency = '-';
                    $document->contract_date = '-';

                    $document->save(false);
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
                    $debet = trim(str_replace(".", ",", $debet));
                    $document->detail_debet = $debet;
                    $kredit = trim(str_replace(",", "", $value[6]));
                    $kredit = trim(str_replace(".", ",", $kredit));
                    $document->detail_kredit = $kredit;
                    $document->detail_purpose_of_payment =$value[4];
                    $document->code_currency = '-';

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

//        composer require phpoffice/phpexcel
//        require_once __DIR__ . '/PHPExcel/Classes/PHPExcel.php';
//        require_once __DIR__ . '/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';

        //Создаем экземпляр класса PHPExcel.
        $xls = new \PHPExcel();

        // Писать будем в первый лист.
        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();

        // Ширина задается в количестве символов.
        $sheet->getColumnDimension('A')->setWidth(5);//bank MFO
        $sheet->getColumnDimension('B')->setWidth(10);//bank INN
        $sheet->getColumnDimension('C')->setWidth(10);//Korxona nomi
        $sheet->getColumnDimension('D')->setWidth(10);//Korxona INN
        $sheet->getColumnDimension('E')->setWidth(30);//Korxona X/R
        $sheet->getColumnDimension('F')->setWidth(20);//Dokument sanasi
        $sheet->getColumnDimension('G')->setWidth(40);//Oraliq davr
        $sheet->getColumnDimension('G')->setWidth(40);//Xamkor korxona nomi
        $sheet->getColumnDimension('G')->setWidth(10);//Xamkor korxona X/R
        $sheet->getColumnDimension('G')->setWidth(10);//Provodka sanasi
        $sheet->getColumnDimension('G')->setWidth(10);//To`lov maqsadi
        $sheet->getColumnDimension('G')->setWidth(10);//valyuta kodi
        $sheet->getColumnDimension('G')->setWidth(10);//Debet
        $sheet->getColumnDimension('G')->setWidth(10);//Kredit
        $sheet->getColumnDimension('G')->setWidth(10);//Shartnoma sanasi
        $sheet->getColumnDimension('G')->setWidth(10);//Shartnoma raqami

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
        $sheet->getStyle("A{$line}")->getFont()->setSize(18);

        // Пропускаем строку после заголовка.
        $line++;
        $sheet->setCellValue("A{$line}", '');
        $sheet->mergeCells("A{$line}:G{$line}");

        //Информация о поставщике
        $line++;
        $sheet->setCellValue("A{$line}", 'Поставщик:');
        $sheet->setCellValue("B{$line}", htmlspecialchars_decode('ООО Рога'));
        $sheet->getStyle("B{$line}")->getFont()->setBold(true);
        $sheet->mergeCells("B{$line}:G{$line}");

        $line++;
        $sheet->setCellValue("B{$line}", 'Адрес: г. Москва, ул. Тверская, д.24, тел: 8 (923) 123-45-67');
        $sheet->mergeCells("B{$line}:G{$line}");

        // Информация о покупателе
        $line++;
        $sheet->setCellValue("A{$line}", 'Покупатель:');
        $sheet->setCellValue("B{$line}", 'Иванов Иван Иванович');
        $sheet->getStyle("B{$line}")->getFont()->setBold(true);
        $sheet->mergeCells("B{$line}:G{$line}");

        $line++;
        $sheet->setCellValue("B{$line}", 'Тел 9 (999) 999-99-99');
        $sheet->mergeCells("B{$line}:G{$line}");

        //Пропускаем строку.
        $line++;
        $sheet->setCellValue("A{$line}", '');
        $sheet->mergeCells("A{$line}:G{$line}");

        //Запоминаем строку с которой начинается таблица чтобы потом сделать рамку.
        $line++;
        $start_table = $line;

        //Шапка таблицы
        $sheet->setCellValue("A{$line}", 'п/п');
        $sheet->setCellValue("B{$line}", 'Артикул');
        $sheet->setCellValue("C{$line}", 'Название');
        $sheet->setCellValue("D{$line}", 'Кол-во');
        $sheet->setCellValue("E{$line}", 'Ед.');
        $sheet->setCellValue("F{$line}", 'Цена');
        $sheet->setCellValue("G{$line}", 'Сумма');

        //Стили для текста в шапки таблицы.
        $sheet->getStyle("A{$line}:G{$line}")->getFont()->setBold(true);
        $sheet->getStyle("A{$line}:G{$line}")->getAlignment()->setWrapText(true);
//        $sheet->getStyle("A{$line}:G{$line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//        $sheet->getStyle("A{$line}:G{$line}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        //В данном примере товары представлены в виде массива.
        $prods = array(
            array(
                'sku'   => '8545775',
                'name'  => 'Боксерские перчатки GREEN HILL Super Star (без марки AIBA)',
                'price' => '6060',
                'count' => '2'
            ),
            array(
                'sku'   => '865645',
                'name'  => 'Боксерский мешок 120X35, 46 кг',
                'price' => '9900',
                'count' => '1'
            ),
            array(
                'sku'   => '865643',
                'name'  => 'Кронштейн для боксерского мешка',
                'price' => '4800',
                'count' => '3'
            ),
        );


        // Далее в цикле выводим товары.

        foreach ($prods as $i => $prod) {
            $line++;
            $sheet->setCellValue("A{$line}", ++$i);
            $sheet->setCellValue("B{$line}", $prod['sku']);
            $sheet->setCellValue("C{$line}", $prod['name']);
            $sheet->setCellValue("D{$line}", $prod['count']);
            $sheet->setCellValue("E{$line}", 'шт.');
            $sheet->setCellValue("F{$line}", number_format($prod['price'], 2, ',', ' '));
            $sheet->setCellValue("G{$line}", number_format($prod['price'] * $prod['count'], 2, ',', ' '));

            // Выравнивание текста в ячейках.
//            $sheet->getStyle("A{$line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $sheet->getStyle("B{$line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//            $sheet->getStyle("C{$line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//            $sheet->getStyle("D{$line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
//            $sheet->getStyle("E{$line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//            $sheet->getStyle("F{$line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
//            $sheet->getStyle("G{$line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            // Подсчет "Итого".
            @$total += $prod['price'] * $prod['count'];
        }


        //Добавляем рамку к таблице.
//        $sheet->getStyle("A{$start_table}:G{$line}")->applyFromArray(
//            array(
//                'borders' => array(
//                    'allborders' => array(
//                        'style' => PHPExcel_Style_Border::BORDER_THIN
//                    )
//                )
//            )
//        );


        //Итого
        $line++;
        $sheet->setCellValue("A{$line}", 'Итого:');
        $sheet->mergeCells("A{$line}:F{$line}");

        $sheet->setCellValue("G{$line}", number_format($total, 2, ',', ' '));
        $sheet->getStyle("A{$line}:G{$line}")->getFont()->setBold(true);
//        $sheet->getStyle("A{$line}:G{$line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


        // НДС (20% от итого)
        $line++;
        $sheet->setCellValue("A{$line}", 'В том числе НДС:');
        $sheet->mergeCells("A{$line}:F{$line}");

        $sheet->setCellValue("G{$line}", number_format(($total / 100) * 20, 2, ',', ' '));
        $sheet->getStyle("A{$line}:G{$line}")->getFont()->setBold(true);
//        $sheet->getStyle("A{$line}:G{$line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


        // Всего наименований
        $line++;
        $sheet->setCellValue(
            "A{$line}",
            'Всего наименований ' . count($prods) . ', на сумму ' . number_format($total, 2, ',', ' ') . ' руб.'
        );
        $sheet->mergeCells("A{$line}:G{$line}");



        //Сумма прописью
        //Здесь используется функция num2str() для получение суммы прописью, взято с https://habrahabr.ru/post/53210/.

        //Еще нужно у суммы прописью сделать первую букву заглавной. Т.к. скрипт в UTF-8 функция ucfirst не работает, поэтому используется аналог – mb_ucfirst().

        $line++;
        $sheet->setCellValue("A{$line}", '123');
        $sheet->getStyle("A{$line}")->getFont()->setBold(true);
        $sheet->mergeCells("A{$line}:G{$line}");


        //Файл готов
        //Отдаем его браузеру на скачивание
        header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/vnd.ms-excel" );
        header("Content-Disposition: attachment; filename=order.xlsx");

        $objWriter = new \PHPExcel_Writer_Excel2007($xls);
        $objWriter->save('php://output');

        $date = date('dd.mm.YYYY H:m:s');

        // Или сохраняем на сервере
        $objWriter = new \PHPExcel_Writer_Excel2007($xls);
        $objWriter->save('downloads/order( '.$date.').xlsx');
        exit;



//        echo "to EXCEL";

//        $company = Company::find()->where(['id' => $id])->one();
//
//        $searchModel = new FileInfoSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('to-excel');
    }


}
