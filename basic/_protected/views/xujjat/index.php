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
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

    .stil{

        overflow-x:auto;
    }
    /*.stil table{*/
    /*    position: relative;*/
    /*}*/
    /*.stil table thead{*/
    /*    position: -webkit-sticky;*/
    /*    position: absolute;*/
    /*    top: 0;*/
    /*}*/
     .short{
     	text-overflow: ellipsis ;
        white-space: nowrap ;
        width: 100px ;
        overflow: hidden;        
        /*border: 1px solid #000000;*/
    }


</style>



<div >
    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
</div>




<div class="xujjat-index" >

    <h1><?= Html::encode($this->title) ?></h1>
<!---->
<!--    <p>-->
<!--        --><?//= Html::a('Create Xujjat', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
<?// Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'options' => [
//            'class' => ' table-responsive '
            'class' => 'stil',
            'id' => 'stil',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',


                ],

               [
                       'attribute' => 'filecom_id',
                       'value' => 'file.companyName.short_name',
                        'header' => 'Корхона',
               ],


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
                'attribute'=>  'detail_date',
                'value'=>  'detail_date',
                'header' => 'Проводканинг сана',
//                'contentOptions' => ['style' => 'width: 200px;'],
//                'headerOptions' => ['style' => 'width:200px !important'],
            ],
//            [
//                'attribute'=>  'detail_date',
//                'format' => 'text',
//                'header' => 'Проводка сана',
//                'filter'=>false,
//                'contentOptions' => ['style' => ['max-width' => '300px;', 'height' => '100px', 'overflow' => 'auto',
//                    'word-wrap' => 'break-word']]
//
//            ],
            [
                 'attribute'=> 'detail_name',
                 'value'=> 'detail_name',
//                 'value'=> htmlspecialchars_decode('detail_name', ENT_QUOTES),

                 'header' => 'Хамкор номи',
            ],

            [
                'attribute'=>  'detail_inn',
                'value'=>  'detail_inn',
                'header' => 'Хамкор ИНН',
            ],
            [
                'attribute'=> 'detail_account',
                'value'=> 'detail_account',
                'header' => 'Хамкор Х-Р',
            ],
            ['attribute'=>'detail_purpose_of_payment',
                'header' => ' Тўлов мақсади ',
                'format'=>'raw',
                'value' => function($data)
                {
//                    return Html::a(mb_substr($data->detail_purpose_of_payment,0,20).'...',
//                        [Yii::$app->controller->id.'/views','id'=>$data->id],['class'=>'short bank ']);
                    return Html::a(' <div class="short">' .$data->detail_purpose_of_payment. '</div>',
                        [Yii::$app->controller->id.'/views','id'=>$data->id],['class'=>' bank']);
                }
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

//            [
//                'attribute'=> 'contract_date',
//                'value'=> 'contract_date',
//                'header' => 'Шартнома санаси',
//            ],
            [
                'attribute'=>'contract_date',
                'value' => 'contract_date',
                'header' => 'Шартнома санаси',
                'filter' =>  DateTimePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'contract_date',
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

            [
                'attribute'=> 'detail_document_number',
                'value'=> 'detail_document_number',
                'header' => 'Шартнома Рақами',
            ],



//            olingan
//            'expence_type_id',
//            'detail_date',
//            'detail_account',
//            'detail_inn',
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
    var h = window.innerHeight-190;
    document.getElementById("stil").style.height = h+"px";
</script>





