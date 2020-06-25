<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Шартномалар';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div  style="padding-bottom: 30px">
    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
</div>
<div class="contracts-index container">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>-->
<!--        --><?//= Html::a('Create Contracts', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>" Жами {totalCount} ta катор мавжуд",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


//            'id',
            [
                    'attribute'=>'first_company_id',
                    'value'=> 'firstCompany.name',
                    'header' => 'Корхона 1',
            ],
//            'firstCompany.name',
            [
                    'attribute'=>'second_company_id',
                    'value'=> 'secondCompany.name',
                    'header' => 'Корхона 2',
            ],
//            'secondCompany.name',
//        [
//                'attribute' => 'first_company_id',
//                'label' => 'nomi',
//        ],
//            'second_company_id',
//            'contract_number',
            [
                'attribute' => 'contract_number',
                'value' => 'contract_number',
                'header' => 'Шартнома рақами',
//                'options' => ['width'=>'100'],
            ],

//            'contract_date',
            [
                'attribute' => 'contract_date',
                'value' => 'contract_date',
                'header' => 'Шартнома тузилган вақти',
//                'options' => ['width'=>'100'],
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
//                        'format' => 'dd-M-yyyy',
                        'format' => 'd.mm.yyyy',
                        'todayBtn' => true,
                        'clearBtn' => true
                    ]
                ]),

            ],
            [
                'attribute' => 'status',
                'header' => 'Статус',
                'value' => function ($data){
                     return $data->status==1 ? "очиқ": ($data->status==NULL ? "ёпилган": "очиқ");
                    },
                'filter' => ['off','on'],
//                'defoult' => 'on'
//                'andFilterWhere'=> ['status' => 1],
            ],
//            'status',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>Html::a(Yii::t('yii', 'Қўшиш'),
                        ['create'],
                        ['title'=>'Янги банк номини киритиш', 'class' => 'btn btn-danger contracts', 'id'=>'modalButton']),
                    'headerOptions' => ['width' => '10'],
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
            ],
        ],
    ]); ?>

    <?
    Modal::begin([
//        'header' => '<h3>Хисоб рақам қўшиш</h3>',
        'id' => 'modal',
    ]);
    ?>
    <div id="modalContent">

    </div>
    <?php
    Modal::end();
    ?>
</div>
