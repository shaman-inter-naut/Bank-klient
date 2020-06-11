<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Файллар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-index">

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
//            'company_inn',
            [
                    'attribute' => 'company_inn',
                    'header' => 'Корхона инниси'
            ],
//            'bank_mfo',
            [
                'attribute' => 'bank_mfo',
                'header' => 'Банк МФО'
            ],
//            'company_account_number',
            [
                'attribute' => 'company_account_number',
                'header' => 'Корхона Х/Р'
            ],
//            'file_date',
            [
                'attribute' => 'file_date',
                'header' => 'Вақт'
            ],
//            'code_currency',
            [
                'attribute' => 'code_currency',
                'header' => 'Валюта коди'
            ],
//            'period',
            [
                'attribute' => 'period',
                'header' => 'Ўтказма'
            ],
//            'first_sum',
            [
                'attribute' => 'first_sum',
                'header' => 'Бош сумма'
            ],
//            'last_sum',
            [
                'attribute' => 'last_sum',
                'header' => 'Охирги сумма'
            ],
//            'debit',
            [
                'attribute' => 'debit',
                'header' => 'Кирим'
            ],
            [
                'attribute' =>'credit',
                'header' => 'Охирги сумма'
            ],

//            'credit',

//    //        'account_number_id',
//    //        'currency_id',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>Html::a(Yii::t('yii', 'Қўшиш'), ['create'], ['title'=>'Янги банк номини киритиш', 'class' => 'btn btn-danger bank']),
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
