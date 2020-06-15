<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Шартномалар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contracts-index">

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
                        'format' => 'dd-M-yyyy',
                        'todayBtn' => true
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
//                'andFilterWhere'=> ['status' => 1],
            ],
//            'status',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>Html::a(Yii::t('yii', 'Қўшиш'),
                        ['create'],
                        ['title'=>'Янги банк номини киритиш', 'class' => 'btn btn-danger contracts', 'id'=>'modalButton']),
                    'headerOptions' => ['width' => '10'],
            ],
        ],
    ]); ?>

    <?
    Modal::begin([
        'header' => '<h3>Хисоб рақам қўшиш</h3>',
        'id' => 'modal',
    ]);
    ?>
    <div id="modalContent">

    </div>
    <?php
    Modal::end();
    ?>
</div>
