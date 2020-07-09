<?php

namespace app\controllers;

use Yii;
use app\models\Xujjat;
use app\models\XujjatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\FileInfo;
use yii\data\Pagination;
/**
 * XujjatController implements the CRUD actions for Xujjat model.
 */

class XujjatController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function beforeAction($action)
    {

        if (Yii::$app->user->isGuest) {
            if((Yii::$app->controller->action->id!='login') &&
                (Yii::$app->controller->action->id!='signup')){
                $model = new LoginForm();
                return $this->redirect(['/site/login', 'model' => $model]);
            }
        }
        return parent::beforeAction($action);
    }
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
     * Lists all Xujjat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new XujjatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Xujjat model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionViews($id)
    {
        return $this->renderAjax('views', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionTable(){

        if ($_POST){
            $date = $_POST['date'];
            $detail_name = $_POST['detail_name'];
            $detail_inn = $_POST['detail_inn'];
            $detail_account = $_POST['detail_account'];
            $detail_purpose_of_payment = $_POST['detail_purpose_of_payment'];
            $code_currency = $_POST['code_currency'];
            $tip_deb_kred = $_POST['tip_deb_kred'];
            $contract_date = $_POST['contract_date'];
            $company_account = $_POST['company_account'];
            $bank_mfo = $_POST['bank_mfo'];
            $company_inn = $_POST['company_inn'];
            $startDT = $_POST['startDT'];
            $endDT = $_POST['endDT'];
            $short_name = $_POST['short_name'];


            $document = Xujjat::find()->joinWith('file')->joinWith('file.companyName')->andFilterWhere([
                'file_date'=>$date,
                'detail_inn'=>$detail_inn,
                'detail_account'=>$detail_account,
                'code_currency'=>$code_currency,
                'tip_deb_kred'=>$tip_deb_kred,
                'contract_date'=>$contract_date,
                'company_account'=>$company_account,
                'bank_mfo'=>$bank_mfo,
                'company_inn'=>$company_inn,
                ])
                ->andFilterWhere(['between', 'detail_date', $startDT,$endDT.' 23:59:59'])
                ->andFilterWhere(['like', 'detail_purpose_of_payment', $detail_purpose_of_payment])
                ->andFilterWhere(['like', 'detail_name', $detail_name])
                ->andFilterWhere(['like', 'short_name', $short_name]);
//                ->orwhere(['detail_name'=>$detail_name])
//                ->andwhere(['detail_name'=>$detail_name])
//                ->all();

            $pagination = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' => $document->count()
            ]);
            $document=$document->offset($pagination->offset)->limit($pagination->limit)->orderBy(['id'=>SORT_DESC])->all();
            return $this->render('table',[

                'document' => $document,
                'pagination' => $pagination,
            ]);

        }

        $document = Xujjat::find();


        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $document->count()
        ]);
        $document=$document->offset($pagination->offset)->limit($pagination->limit)->orderBy(['id'=>SORT_DESC])->all();
        return $this->render('table',[

            'document' => $document,
            'pagination' => $pagination,

        ]);

    }


    /**
     * Creates a new Xujjat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Xujjat();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Xujjat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Xujjat model.
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
     * Finds the Xujjat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Xujjat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Xujjat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
