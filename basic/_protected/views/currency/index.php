<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurrencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Валюта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div  style="padding-bottom: 30px">
    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
</div>
<div class="container currency-index">
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
            [
                'attribute' => 'name',
                'header' => 'Валюта номи:',
            ],
//            'code',
            [
                'attribute' => 'code',
                'header' => 'Валюта коди:',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>Html::a(Yii::t('yii', 'Қўшиш'), ['create'], ['title'=>'Янги банк номини киритиш', 'class' => 'btn btn-danger bank']),
                'headerOptions' => ['width' => '10'],
                'template' => '{view}  {update}  {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('', ['view', 'id' => $model->id], [
                            'class' => 'glyphicon glyphicon-eye-open bank',

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

</div>



<?
Modal::begin([

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
</style>