<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Корхона';
$this->params['breadcrumbs'][] = $this->title;
?>

<div  style="padding-bottom: 30px">
    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
</div>
<div class="container company-index">

    <div class="info" style="margin-bottom: 10px; padding: 5px;">
        <p><strong style=""><h1><?= Html::encode($this->title) ?></h1></strong></p>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'name',
//            [
//                'attribute' => 'name',
//                'header' => 'Корхона 1:',//
//            ],
            [
                'attribute' => 'short_name',
                'header' => 'Корхона номи:',
            ],
//            'short_name',
            [
                'attribute' => 'inn',
                'header' => 'ИНН',
            ],
//            'inn',
//            'accaunt_begin',
            [
                'attribute' => 'accaunt_begin',
                'header' => 'Хисоб рақам бошланиши',
            ],
            [
                'attribute' => 'unical_code',
                'header' => 'Уникал код',
            ],

//            'unical_code',
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>Html::a(Yii::t('yii', 'Қўшиш'), ['create'], ['title'=>'Янги банк номини киритиш', 'class' => 'btn btn-danger bank']),
                'template' => '{view}  {update}  {delete}',

                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url,
                            [
                                'title' => Yii::t('app', 'Кўриш'),
                                'class' => 'bank'
                            ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                            [
                                'title' => Yii::t('app', 'Тахрирлаш'),
                                'class' => 'bank'
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
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['view','id' => $model->id]);
                    }
                    if ($action === 'update') {
                        return Url::to(['update','id' => $model->id]);
                    }

                }
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



<style type="text/css">
    thead  tr {
        background-color: #4CAF50
    }
    thead {
        color: white
    }
    thead tr a {
        color: white
    }
    .center{
        text-align: center;
    }
</style>
