<?php

use app\models\Bank;
use app\models\Company;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FileInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Файллар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div  style="padding-bottom: 30px">
    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
</div>

<style>
    .alert {
        padding: 20px;
        background-color: #f44336;
        color: white;
        opacity: 1;
        transition: opacity 0.6s;
        margin-bottom: 15px;
    }

    .alert.success {background-color: #4CAF50;}
    .alert.info {background-color: #2196F3;}
    .alert.warning {background-color: #ff9800;}

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
</style>

<div class="container file-info-index">





    <h1><?= Html::encode("ФАЙЛЛАР") ?></h1>

    <hr style="border: 5px solid darkslategrey">

    <p>
        <?= Html::a('+', ['create'], ['class' => 'bank btn btn-primary']) ?>
    </p>

    <?php if (
        isset($_SESSION['mfo'])
        && isset($_SESSION['main'])
        && isset($_SESSION['inn'])
    ){

        ?>
        <div class="alert info" style="text-align: center">
            <span class="closebtn">&times;</span>
            <b><h4 style="color:white">Сиз юклаган файлда ушбу маълумотлар мавжуд ЭМАС:</h4></b><hr>

            <table style="text-align: left" border="0" width="100%">
                <tr style="border: 0px solid red; color:black">
                    <td width="25%">Банк МФО:</td>
                    <td width="75%"><?= $_SESSION['mfo']; ?></td>
                </tr>
                <tr style="border: 0px solid red; color:black">
                    <td width="25%">Корхона хисоб рақами:</td>
                    <td width="75%"><?= $_SESSION['main']; ?></td>
                </tr>
                <tr style="border: 0px solid red; color:black">
                    <td width="25%">Корхона ИНН: </td>
                    <td width="75%"><?= $_SESSION['inn']; ?></td>
                </tr>
            </table>
            <br>
            <h6 style="color:white">Шу сабабли ушбу файлдаги маълумотлар базага сақланмади !</h6>
        </div>
        <?php session_destroy(); } ?>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //    'id',
            [
                'attribute'=>'company_inn',
                'header'=> 'Корхона номи',
            ],
            [
                'attribute'=>'company_account',
                'header'=> 'Хисоб рақами',
            ],

            ['attribute'=>'file_name',
                'header'=> 'Файл номи',
                'format'=>'raw',
//                '' => '',
                'value' => function($data)
                {return Html::a($data->file_name, [Yii::$app->controller->id.'/view','id'=>$data->id]);}
            ],

//            [
////                'attribute'=>'company_inn',
////                'value'=> 'companyName.name',
//                'header' => 'Дебет',
//            ],
//
//            [
////                'attribute'=>'company_inn',
////                'value'=> 'companyName.name',
//                'header' => 'Кредит',
//            ],
            [
                'attribute'=>'countDetailToRecord',
                'header'=> 'Жами проводкалар сони',
            ],
            [
                'attribute'=>'countDetailNoRecord',
                'header'=> 'Сақланмаган проводкалар сони',
            ],

            'data_period_start',
            'data_period_end',
            'file_date',


            [
                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view}  {update}  {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('', ['view', 'id' => $model->id], [
                            'class' => 'glyphicon glyphicon-eye-open',

                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('', ['update', 'id' => $model->id], [
                            'class' => 'glyphicon glyphicon-pencil bank',

                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('', ['delete', 'id' => $model->id], [
                            'class' => 'glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => 'Ўчириб юборилсинми?',
                                'method' => 'post',
                            ],
                        ]);
                    },

                ],

            ],
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



