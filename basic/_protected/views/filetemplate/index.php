<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FiletemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Шаблон';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filetemplate-index">

    <div class="info" style="margin-bottom: 10px; padding: 5px;">
        <p><strong style=""><h1><?= Html::encode($this->title) ?></h1></strong></p>
    </div>





    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'bank_id',
            'in_address',
            'mfo_address',
            'hr_address',
            'date_address',
            'file_number_address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
