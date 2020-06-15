<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FileInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Файллар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-info-index">

    <h1><?= Html::encode("ФАЙЛЛАР") ?></h1>

    <hr style="border: 5px solid darkslategrey">

    <p>
        <?= Html::a('+', ['create'], ['class' => 'bank btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'id',
//           'company_inn',

            [
                'attribute'=>'company_inn',
                'value'=> 'companyName.name',
//                'header' => 'Корхона 1',
            ],

//            'bank_mfo',
            'company_account',

            ['attribute'=>'file_name',
                'format'=>'raw',
//                '' => '',
                'value' => function($data)
                {return Html::a($data->file_name, [Yii::$app->controller->id.'/view','id'=>$data->id]);}
            ],

            [
//                'attribute'=>'company_inn',
//                'value'=> 'companyName.name',
                'header' => 'Дебет',
            ],

            [
//                'attribute'=>'company_inn',
//                'value'=> 'companyName.name',
                'header' => 'Кредит',
            ],

            'data_period',
            'file_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?
Modal::begin([
//    'header' => '<h3>Банк қўшиш</h3>',
    'id' => 'modal',
]);
?>
<div id="modalContent">

</div>
<?php
Modal::end();
?>
