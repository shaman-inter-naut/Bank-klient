<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Documents', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'inn_company',
            'mfo_bank',
            'account_number_company',
            'date',
            'document_number',
            'mfo_branch',
            'inn_branch',
            'name_branch',
            'account_number_branch',
            'purpose_branch',
            'code_currency',
            'kirim',
            'chiqim',
            'tip_k_ch',
            'contract_date',
            'contract_number',
//            'contracts_id',
//            'currency_id',
//            'account_number_id',
//            'bank_branch_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

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
