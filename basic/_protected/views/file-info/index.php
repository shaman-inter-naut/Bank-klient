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

    <h1><?= Html::encode("ФАЙЛЛАР") ?></h1>

    <hr style="border: 5px solid darkslategrey">

    <p>
        <?= Html::a('+', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'id',
            'bank_mfo',
            'company_account',
            'company_inn',
            'file_name',
            //'file_date',
            //'data_period',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
