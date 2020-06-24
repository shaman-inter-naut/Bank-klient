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
                'class' => ' table-responsive '
//                'class' => 'table table-responsive text-nowrap'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//
////            'id',
//            [
//                'attribute'=> 'company_inn',
//                'value'=> 'company.name',
//                'header' => 'Корхона 2',
//            ],
//            'company_inn',
//            'bank_mfo',
//            'company_account',
//
//            'file_name',
//            'file_date',
//            'data_period',
//            [
//                'attribute'=> 'id',
//                'value'=> 'doc.detail_account',
//                'header' => 'Хисоб рақам',
//            ],
//            [
//                'attribute'=> 'id',
////                'headerOptions' => ['style' => 'width:20px'],
//                'value'=> 'doc.detail_mfo',
////                'options' => ['width' => '10'],
////                'options' => ['style' => 'max-width:10px;'],
//                'header' => 'Хамкор банк МФО',
//            ],
//            [
//                'attribute'=> 'id',
//                'value'=> 'doc.detail_inn',
//                'header' => 'Хамкор банк ИНН',
//            ],
//            [
//                'attribute'=> 'id',
//                'value'=> 'doc.detail_name',
//                'header' => 'Хамкор банк номи',
//            ],
//
//            [
//                'attribute'=> 'id',
//                'value'=> 'doc.detail_document_number',
//                'header' => 'Хамкор банк хужжат рақа',
//            ],
//
//            [
//                'attribute'=> 'id',
//                'value'=> 'doc.detail_purpose_of_payment',
//                'header' => 'Тўлов мақсади',
////                'options' => ['width' => '80px'],
////                'options' => ['style' => 'max-width:100px;'],
////                'contentOptions' => ['style' => ['max-width' => '100px']]
////                'headerOptions' => ['style' => 'width:20%'],
////                'contentOptions' => ['style' => ['max-width' => '100px;', 'height' => '100px', 'class' => 'text-wrap']]
//            ],
//
//            [
//                'attribute'=> 'id',
//                'value'=> 'doc.code_currency',
//                'header' => 'Валюта коди',
//                'options' => ['width' => '80']
//            ],

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
                'attribute' => 'id',
                'header' => 'Статус',
                'value' => function ($data){
//                    return $data->doc->detail_debet==0 ? "chiqim" : "kirim";
                    return $data->doc->detail_debet==1 ? "очиқ":  "ёпилган";
                },

                'filter' => ['1','0'],
//                'andFilterWhere'=> ['status' => 1],
            ],
            [
                'attribute'=> 'id',
                'value'=> 'doc.contract_date',
                'header' => 'шартнома санаси',
                'options' => ['width' => '80']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
