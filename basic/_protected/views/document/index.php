<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Хужжатлар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>-->
<!--        --><?//= Html::a('Create Document', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'options' => [
            'class' => ' table-responsive '
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'file_id',
            [
                'attribute'=> 'file_id',
                'value'=> 'fileDoc.company.short_name',
                'header' => 'Корхона номи',
            ],
            [
                'attribute'=> 'file_id',
                'value'=> 'fileDoc.bank_mfo',
                'header' => 'МФО',
            ],
//            [
//                'attribute'=> 'file_id',
//                'value'=> 'fileDoc.company_account',
//                'header' => 'Х-Р',
//            ],
//            [
//                'attribute'=> 'file_id',
//                'value'=> 'fileDoc.file_date',
//                'header' => 'Сана',
//            ],
//            [
//                'attribute'=> 'file_id',
//                'value'=> 'fileDoc.data_period',
//                'header' => 'Сана оралиқ',
//            ],
//            [
//                'attribute'=> 'file_id',
//                'value'=> 'fileDoc.company_inn',
//                'header' => 'ИНН',
//            ],
            [
                'attribute'=> 'detail_name',
                'value'=> 'detail_name',
                'header' => 'Хамкор номи',
            ],

            [
                'attribute'=> 'detail_account',
                'value'=> 'detail_account',
                'header' => 'Хамкор Х-Р',
            ],

            ['attribute'=>'detail_purpose_of_payment',
                'header' => 'Тўлов мақсади',

                'format'=>'raw',
                'value' => function($data)
                {return Html::a('Мақсад ', [Yii::$app->controller->id.'/views','id'=>$data->id],['class'=>'bank',]);}
            ],

            [
                'attribute'=> 'code_currency',
                'value'=> 'code_currency',
                'header' => 'Валюта коди',
            ],
            [
                'attribute'=> 'detail_debet',
                'value'=> 'detail_debet',
                'header' => 'Кирим',
            ],
            [
                'attribute'=> 'detail_kredit',
                'value'=> 'detail_kredit',
                'header' => 'Чиқим',
            ],
            [
                'attribute' => 'tip_deb_kred',
                'header' => 'Статус',
                'value' => function ($data){
                    return $data->tip_deb_kred==1 ? "кирим": ($data->tip_deb_kred==NULL ? "чиқим": "кирим");
                },
                'filter' => ['чиқим','кирим'],
//                'andFilterWhere'=> ['status' => 1],
            ],

            [
                'attribute'=> 'contract_date',
                'value'=> 'contract_date',
                'header' => 'Шартнома санаси',
            ],
            [
                'attribute'=> 'detail_document_number',
                'value'=> 'detail_document_number',
                'header' => 'Шартнома Рақами',
            ],
//            'detail_date',
//            'detail_account',
//            'detail_inn',
            //'detail_name',
            //'detail_document_number',
            //'detail_mfo',
            //'detail_debet',
            //'detail_kredit',
            //'detail_purpose_of_payment',
            //'code_currency',
            //'contract_date',
            //'tip_deb_kred',

            [
                'class' => 'yii\grid\ActionColumn',
//                'header'=>Html::a(Yii::t('yii', 'Қўшиш'), ['create'], ['title'=>'Янги банк номини киритиш', 'class' => 'btn btn-danger bank']),
                'headerOptions' => ['width' => '50'],
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
//    'header' => 'Тўлов мақсади',
    'id' => 'modal',
]);
?>
<div id="modalContent">

</div>
<?php
Modal::end();
?>

