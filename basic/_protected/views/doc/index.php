<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Xujjatlar';
$this->params['breadcrumbs'][] = $this->title;
?>

<div >
    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
</div>

<div class="container-fluid">
    <h1><?=$this->title ?></h1>

<table class="table table-striped">
    <thead class="thed" >
        <tr>
            <th>tr</th>
            <th>FIO</th>
            <th>Manzil</th>
            <th>TEl</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Sardor</td>
            <td>Asaka</td>
            <td>979933632</td>
        </tr>
    </tbody>
</table>

</div>










<!--<div class="xujjat-index">-->
<!---->
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!---->
<!--    <p>-->
<!--        --><?//= Html::a('Create Xujjat', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
<!---->
<!--    --><?php //// echo $this->render('_search', ['model' => $searchModel]); ?>
<!---->
<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'file_id',
//            'expence_type_id',
//            'detail_date',
//            'detail_account',
//            //'detail_inn',
//            //'detail_partner_unique_code',
//            //'detail_name',
//            //'detail_document_number',
//            //'detail_mfo',
//            //'detail_debet',
//            //'detail_kredit',
//            //'detail_purpose_of_payment:ntext',
//            //'code_currency',
//            //'contract_date',
//            //'tip_deb_kred',
//            //'company_account_id',
//            //'data_id',
//            //'period_id',
//            //'inn_id',
//            //'filecom_id',
//            //'company_unikal',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>
<!---->
<!---->
<!--</div>-->
