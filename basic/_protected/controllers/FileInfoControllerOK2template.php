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

        if ($model->load(Yii::$app->request->post())) {

            $model->file = UploadedFile::getInstance($model, 'file');
            $fileName = $model->file->baseName;

//            $bank = Bank::find()->where(['name' => $fileName])->one();
//            echo "Шаблон: ".$bank->template;



            $model->file->saveAs('uploads/' . $fileName . '.' . $model->file->extension);

            $filePath = $fileName . '.' . $model->file->extension;

            $fp = fopen('uploads/' . $filePath, 'r') or die ("can't open file");

            $details = false;
            $position = 0;
            $needed_detail = -1;
            $eee = [];
            $results = [];
            $res = [];
            while ($s = fgets($fp)) {

//                $fields = mb_convert_encoding ($s, "utf-8", 'Windows-1251');
//                print_r($s);

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
//                    echo "<pre>";
//                    print_r($key . ": ");
//                    print_r($matches);
//                    echo "</pre>";
                            $results[$key] = $matches[0][0];

                        }
                    }
                }

//                echo "<pre>";
//                print_r($s);
//                echo "</pre>";

                //   echo strpos($s,"Корреспондент:");



//              begin   Asosiy contentni ichini o`qish

                if(strpos($s,"Корреспондент:")){
                    $details=true;
                    $position++;
//echo strpos($s,"Корреспондент:");
                }

                if($details) $position++;
                if($details & $position>3) {
                    $rrr = explode("|", $s);

//            echo "<pre>";
//            print_r(count($rrr));
//            "</pre>";

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


//                            $detail_date = $eee[$needed_detail][0] ;
//                            $satr = $eee[$needed_detail][1];
//                            $detail_account = substr($eee[$needed_detail][1], 0, 20) ;
//                            $detail_find_pos_INN = strpos($satr, 'ИНН');
//                            $detail_inn = substr($eee[$needed_detail][1], $detail_find_pos_INN+6,   10);
//                            $detail_nomer = $eee[$needed_detail][2];
//                            $detail_mfo = $eee[$needed_detail][4];
//                            $detail_debet = $eee[$needed_detail][5];
//                            $detail_kredit = $eee[$needed_detail][6];
//                            $detail_purpose = $eee[$needed_detail][7];


                        }
                    }
                }
//              end     Asosiy contentni ichini o`qish



            }


//            echo "<pre>";
//            print_r($results);
//            "</pre>";

//            $pos = strpos($results['mfo'], '-');
//            $mfo = substr($results['mfo']);
            $mfo = trim(str_replace("-", "", $results['mfo']));
            $acc = trim(str_replace("Счет:", "", $results['acc']));
            $date = trim(str_replace("Изг", "", $results['date']));
            $interval1 = trim(str_replace("СЧЕТА за", "", $results['interval1']));
            $interval2 = trim(str_replace("посл.проводки :", "", $results['interval2']));
            $interval = $interval1.' - '.$interval2;

//            echo "<pre>";
//            print_r($mfo.'<br>');
//            print_r($acc.'<br>');
////            print_r($inn.'<br>');
//            print_r($date.'<br>');
//            print_r($interval.'<br>');
//            "</pre>";




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







//        echo
//            "<pre>";
//                print_r($eee);
//            "</pre>";
//        die;

            foreach ($eee as $key =>$value)
            {
                //$fileInfo=new FileInfo();

//             echo   $date = $value[1].'<br>';
//             echo   $doc_number = $value[2].'<br>';

                // preg_match('/(?P<acc>\d+)\s+(?P<name1>\D+)\s+(?P<inn>\d+)/', $value[1], $matches);

                $pat = array(
                    "mfo" => "(\d{5})",   //mfo
                    "acc" => "(\d{20})",   //mfo
//                    "purpose" => "([ИНН:]\s+\D+)",   //mfo
                );

                foreach ($pat as $key => $p) {
                    preg_match($p, $value[4], $m, PREG_OFFSET_CAPTURE, 0);
                    if ($m) {
//                        echo "<pre>";
//                        print_r($key . ": ");
//                        print_r($m);
//                        echo "</pre>";
                        $res[$key] = $m[0][0];

                    }
                }

//             echo    $mfo     = $res['mfo'].'<br>';
//             echo    $acc     = $res['acc'].'<br>';
//
//             echo   $purpose = $value[4].'<br>';
//             echo   $debet = $value[5].'<br>';
//             echo   $kredit = $value[6].'<hr>';



                $document=new Document();
                $document->file_id = $lastID;
                $document->detail_date = $value[1];
                $document->detail_document_number = $value[2];

                // preg_match('/(?P<acc>\d+)\s+(?P<name1>\D+)\s+(?P<inn>\d+)/', $value[1], $matches);

                $document->detail_inn = '-';
                $document->detail_account = $res['acc'];
//                $document->detail_inn ='44444';// $eee[1];
                $document->detail_name ='-';// $eee[1];
                $document->detail_mfo = $res['mfo'];
                $document->detail_debet = $value[5];
                $document->detail_kredit = $value[6];
                $document->detail_purpose_of_payment =$value[4];
                $document->code_currency = '-';
                $document->contract_date = '-';

                $document->save(false);
            }




            /* END Fayl import qilish va ma`lumotlarni bazaga saqlash */

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
}
