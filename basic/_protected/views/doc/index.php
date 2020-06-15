<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FileInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'File Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-info-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create File Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'options' => [
                'class' => 'table table-responsive text-nowrap'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute'=> 'company_inn',
                'value'=> 'company.name',
                'header' => 'Корхона 2',
            ],
            'company_inn',
            'bank_mfo',
            'company_account',

            'file_name',
            'file_date',
            'data_period',
            [
                'attribute'=> 'id',
                'value'=> 'doc.detail_account',
                'header' => 'Хисоб рақам',
            ],
            [
                'attribute'=> 'id',
                'value'=> 'doc.detail_mfo',
                'header' => 'Хамкор банк МФО',
            ],
            [
                'attribute'=> 'id',
                'value'=> 'doc.detail_inn',
                'header' => 'Хамкор банк ИНН',
            ],
            [
                'attribute'=> 'id',
                'value'=> 'doc.detail_name',
                'header' => 'Хамкор банк номи',
            ],

            [
                'attribute'=> 'id',
                'value'=> 'doc.detail_document_number',
                'header' => 'Хамкор банк хужжат рақа',
            ],

            [
                'attribute'=> 'id',
                'value'=> 'doc.detail_purpose_of_payment',
                'header' => 'Тўлов мақсади',
                'options' => ['class' => 'eni']
            ],

            [
                'attribute'=> 'id',
                'value'=> 'doc.code_currency',
                'header' => 'Валюта коди',
                'options' => ['width' => '80']
            ],

            [
                'attribute'=> 'id',
                'value'=> 'doc.detail_debet',
                'header' => 'Кирим',
                'options' => ['width' => '80']
            ],

            [
                'attribute'=> 'id',
                'value'=> 'doc.detail_kredit',
                'header' => 'Чиқим',
                'options' => ['width' => '80']
            ],

            [
                'attribute'=> 'id',
                'value'=> 'doc.contract_date',
                'header' => 'шартнома санаси',
                'options' => ['width' => '80']
            ],

            [
                'attribute' => 'id',
                'header' => 'Статус',
                'value' => function ($data){
                    return $data->doc->tip_deb_kred==1 ? "очиқ": ($data->status==NULL ? "ёпилган": "очиқ");
                },
                'filter' => ['kirim','chiqim'],
//                'andFilterWhere'=> ['status' => 1],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
