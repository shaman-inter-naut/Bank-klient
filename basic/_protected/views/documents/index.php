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

            'id',
            'file_id',
            'detail_date',
            'detail_account',
            'detail_inn',
            //'detail_name',
            //'detail_document_number',
            //'detail_mfo',
            //'detail_debet',
            //'detail_kredit',
            //'detail_purpose_of_payment:ntext',
            //'code_currency',
            //'contract_date',
            //'tip_deb_kred',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
