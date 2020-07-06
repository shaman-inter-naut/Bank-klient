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
            $document = Xujjat::find()->joinWith('file')->joinWith('file.file_date')->where(['file_id'=>$date])->all();

            return $this->render('table',[

                'document' => $document,
//            var_dump($document); die;
            ]);

        }

        $document = Xujjat::find()->all();

        return $this->render('table',[

            'document' => $document,

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
