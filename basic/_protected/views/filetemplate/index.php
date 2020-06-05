<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FiletemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Filetemplates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filetemplate-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Filetemplate', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'bank_id',
            'in_address',
            'mfo_address',
            'hr_address',
            //'date_address',
            //'file_number_address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
