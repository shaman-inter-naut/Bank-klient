<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contracts';
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
            'firstCompany.name',
            'secondCompany.name',
//        [
//                'attribute' => 'first_company_id',
//                'label' => 'nomi',
//        ],
//            'second_company_id',
            'contract_number',
//            'contract_date',
            [
                'attribute' => 'contract_date',
                'value' => 'contract_date',
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
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>Html::a(Yii::t('yii', 'Қўшиш'),
                        ['create'],
                        ['title'=>'Янги банк номини киритиш', 'class' => 'btn btn-danger', 'id'=>'modalButton']),
                    'headerOptions' => ['width' => '10'],
            ],
        ],
    ]); ?>

    <?
    Modal::begin([
        'header' => '<h3>Хисоб ракам кошиш</h3>',
        'id' => 'modal',
    ]);
    ?>
    <div id="modalContent">
        SALOM
    </div>
    <?php
    Modal::end();
    ?>
</div>
