<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Корхона';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

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
                'headerOptions' => ['width' => '10'],
            ],
        ],
    ]); ?>


</div>

<?
Modal::begin([
    'header' => '<h3>Банк қўшиш</h3>',
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
