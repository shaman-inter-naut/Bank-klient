<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\XujjatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Xujjats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xujjat-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Xujjat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'file_id',
//            'file.bank_mfo',
               [
                   'attribute'=>'file_id',
                   'value' => 'file.bank_mfo'
               ],
               [
                   'attribute'=>'company_account_id',
                   'value' => 'companyAccount.company_inn'
               ],

//            'expence_type_id',
//            'detail_date',
//            'detail_account',
            //'detail_inn',
            //'detail_partner_unique_code',
            //'detail_name',
            //'detail_document_number',
            //'detail_mfo',
            //'detail_debet',
            //'detail_kredit',
            //'detail_purpose_of_payment:ntext',
            //'code_currency',
            //'contract_date',
            //'tip_deb_kred',
//            'company_account_id',
//            'companyAccount.company_inn',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
