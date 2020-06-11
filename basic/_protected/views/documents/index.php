<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Хужжатлар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-index">
    <div class="info" style="margin-bottom: 10px; padding: 5px;">
        <p><strong style=""><h1><?= Html::encode($this->title) ?></h1></strong></p>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'inn_company',
            [
                    'attribute' => 'inn_company',
                    'header' => 'Корхона ИНН си'
            ],
            [
                    'attribute' =>  'mfo_bank',
                    'header' => 'Банк МФО'
            ],
            [
                    'attribute' =>  'account_number_company',
                    'header' => 'Корхона Х/Р'
            ],
//            'mfo_bank',
//            'account_number_company',
            [
                'attribute' => 'date',
                'header' => 'Сана'
            ],
//            'date',
            [
                'attribute' => 'document_number',
                'header' => 'Хужжат рақами'
            ],
//            'document_number',
            [
                'attribute' =>  'mfo_branch',
                'header' => 'Банк филиали МФО'
            ],
//            'mfo_branch',
            [
                'attribute' =>    'inn_branch',
                'header' => 'Банк филиали ИНН'
            ],
//            'inn_branch',
            [
                'attribute' =>     'name_branch',
                'header' => 'Банк филиали номи'
            ],
//            'name_branch',
            [
                'attribute' =>   'account_number_branch',
                'header' => 'Банк филиали Х/Р'
            ],
//            'account_number_branch',
            [
                'attribute' =>  'purpose_branch',
                'header' => 'назначения'
            ],
//            'purpose_branch',
            [
                'attribute' =>  'code_currency',
                'header' => 'Валюта коди'
            ],
//            'code_currency',
            [
                'attribute' =>   'kirim',
                'header' => 'Кирим'
            ],
//            'kirim',
            [
                'attribute' =>  'chiqim',
                'header' => 'Кирим'
            ],
//            'chiqim',
            [
                'attribute' =>  'tip_k_ch',
                'header' => 'Кирим чиқим типи'
            ],
//            'tip_k_ch',
            [
                'attribute' =>  'contract_date',
                'header' => 'Шартнома санаси'
            ],
//            'contract_date',
            [
                'attribute' =>   'contract_number',
                'header' => 'Шартнома раыами'
            ],
//            'contract_number',
//           // 'contracts_id',
//            //'currency_id',
//            //'account_number_id',
//            //'bank_branch_id',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>Html::a(Yii::t('yii', 'Қўшиш'), ['create'], ['title'=>'Янги банк номини киритиш', 'class' => 'btn btn-danger ']),
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
