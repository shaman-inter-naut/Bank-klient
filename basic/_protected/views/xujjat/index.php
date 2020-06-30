<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use dosamigos\datetimepicker\DateTimePicker;
use kartik\daterange\DateRangePicker;
use kartik\field\FieldRange;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;


/* @var $this yii\web\View */
/* @var $searchModel app\models\XujjatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Хужжатлар';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .stil{
        /*position:fixed;*/
        overflow-x:auto;
    }
</style>

<div  style="padding-bottom: 30px">
    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
</div>
<div class="xujjat-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!---->
<!--    <p>-->
<!--        --><?//= Html::a('Create Xujjat', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
<?// Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'options' => [
//            'class' => ' table-responsive '
            'class' => 'stil',
            'id' => 'stil',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',

                ],

//            'id',
//            'file_id',
//            'file.bank_mfo',
//                'file.company.short_name',
               [
                       'attribute' => 'filecom_id',
                       'value' => 'file.companyName.short_name',
                        'header' => 'Kompany',
               ],



//            [
//                'attribute'=> 'detail_date',
//                'value' => 'detail_date',
//                'header' => 'detail_date',
//                'filter' =>  DateRangePicker::widget([
//                        'model'=>$searchModel,
//                        'attribute'=>'detail_date',
//                        'convertFormat'=>true,
//                        'startAttribute'=>'datetime_min',
//                        'endAttribute'=>'datetime_max',
//                        'pluginOptions'=>[
//                    //        'timePicker'=>true,
//                            'timePickerIncrement'=>30,
//                             'format'=>'d.mm.yyyy',
//                            'locale'=>[
//                                'format'=>'d.mm.yyyy'
//                            ]
//                        ]
//                    ])
//            ],

               [
                   'attribute'=>'file_id',
                   'value' => 'file.bank_mfo',
                   'header' => 'МФО',
               ],
               [
                   'attribute'=>'inn_id',
                   'value' => 'file.company_inn',
                   'header' => 'ИНН',
               ],
               [
                   'attribute'=>'company_account_id',
                   'value' => 'file.company_account',
                    'header' => 'Х-Р',
               ],
               [
                   'attribute'=>'data_id',
                   'value' => 'file.file_date',
                   'header' => 'Сана',
                   'filter' =>  DateTimePicker::widget([
                       'model' => $searchModel,
                       'attribute' => 'data_id',
                       'template' => '{input}',
                       'language' => 'ru',
                       'size' => 'ms',
                       'clientOptions' => [
                           'startView' => 2,
                           'minView' => 2,
                           'maxView' => 0,
                           'autoclose' => true,
//                        'format' => 'dd-M-yyyy',
                           'format' => 'd.mm.yyyy',
                           'todayBtn' => true,
                           'clearBtn' => true

                       ]
                   ]),
               ],

               [
                   'attribute'=>'period_id',
                   'value' => 'file.data_period',
                   'header' => 'Сана оралиқ',

                   'filter' =>  DateTimePicker::widget([
                       'model' => $searchModel,
                       'attribute' => 'period_id',
                       'template' => '{input}',
                       'language' => 'ru',
                       'size' => 'ms',
                       'clientOptions' => [
                           'startView' => 2,
                           'minView' => 2,
                           'maxView' => 0,
                           'autoclose' => true,
                           'format' => 'd.mm.yyyy',
                           'todayBtn' => true,
                           'clearBtn' => true

                       ]
                   ]),
               ],
//            'detail_date',
            [
                'attribute'=>  'detail_date',
                'value'=>  'detail_date',
                'header' => 'Правотка сана',
            ],

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
//            'detail_date',
//            [
//                'attribute'=> 'detail_date',
//                'value' => 'detail_date',
//                'header' => '-Сана-',
//                'filter' =>  DateTimePicker::widget([
//                    'model' => $searchModel,
//                    'attribute' =>  'detail_date',
//                    'template' => '{input}',
//                    'language' => 'ru',
//                    'size' => 'ms',
//                    'clientOptions' => [
//                        'startView' => 2,
//                        'minView' => 2,
//                        'maxView' => 0,
//                        'autoclose' => true,
//                        'format' => 'd.mm.yyyy',
//                        'todayBtn' => true,
//                        'clearBtn' => true
//
//                    ]
//                ]),
//            ],
//            [
//                'attribute'=>'detail_date',
////                'fotmat' => 'date',
//                'value' => 'detail_date',
//                'header' => '-Сана-',
//                'filter' =>   \kartik\field\FieldRange::widget([
//                    'model' => $searchModel,
//                    'type'=>\kartik\field\FieldRange::INPUT_WIDGET,
//                    'attribute1' => 'from_date',
//                    'attribute2' => 'to_date',
////                    'template' => '{input}',
//                    'widgetClass'=> \kartik\datecontrol\DateControl::className(),
////                    'widgetClass'=> \kartik\date\DatePicker::className(),
//                    'widgetOptions1'=>[
//                            'saveFormat' => 'php:U'
//                    ],
//                    'widgetOptions2'=>[
//                        'saveFormat' => 'php:U'
//                    ],
//                 ]),
//            ],
            ['attribute'=>'detail_purpose_of_payment',
                'header' => 'Тўлов мақсади',

                'format'=>'raw',
                'value' => function($data)
                {return Html::a('Кўриш ', [Yii::$app->controller->id.'/views','id'=>$data->id],['class'=>'bank',]);}
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

//                    'filter' =>  DateTimePicker::widget([
//                        'model' => $searchModel,
//                        'attribute' => 'contract_date',
//                        'template' => '{input}',
//                        'language' => 'ru',
//                        'size' => 'ms',
//                        'clientOptions' => [
//                            'startView' => 2,
//                            'minView' => 2,
//                            'maxView' => 0,
//                            'autoclose' => true,
//                            'format' => 'd.mm.yyyy',
//                            'todayBtn' => true,
//                            'clearBtn' => true
//
//                        ]
//                    ]),
            ],

            [
                'attribute'=> 'detail_document_number',
                'value'=> 'detail_document_number',
                'header' => 'Шартнома Рақами',
            ],


            'expence_type_id',
            'detail_date',
            'detail_account',
            'detail_inn',
//            'detail_partner_unique_code',
//            'detail_name',
//            'detail_document_number',
//            'detail_mfo',
//            'detail_debet',
//            'detail_kredit',
//            'detail_purpose_of_payment:ntext',
//            'code_currency',
//            'contract_date',
            //'tip_deb_kred',
//            'company_account_id',
//            'companyAccount.company_inn',

//            [
//                'class' => 'yii\grid\ActionColumn',
//                'header'=>Html::a(Yii::t('yii', 'Қўшиш'), ['create'], ['title'=>'Янги банк номини киритиш', 'class' => 'btn btn-danger bank']),
//                'headerOptions' => ['width' => '50'],
//                'template' => ' {delete}',
//                'buttons' => [
//                    'view' => function ($url, $model) {
//                        return Html::a('', ['view', 'id' => $model->id], [
//                            'class' => 'glyphicon glyphicon-eye-open bank',
//
//                        ]);
//                    },
//                    'update' => function ($url, $model) {
//                        return Html::a('', ['update', 'id' => $model->id], [
//                            'class' => 'glyphicon glyphicon-pencil bank',
//
//                        ]);
//                    },
//                    'delete' => function ($url, $model) {
//                        return Html::a('', ['delete', 'id' => $model->id], [
//                            'class' => 'glyphicon glyphicon-trash',
//                            'data' => [
//                                'confirm' => 'Ўчириб юборилсинми?',
//                                'method' => 'post',
//                            ],
//                        ]);
//                    },

//                ],

//            ],
        ],
    ]); ?>
<?// Pjax::end(); ?>

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
<script>
    var w = window.innerWidth;
    var h = window.innerHeight-220;
    document.getElementById("stil").style.height = h+"px";
</script>
