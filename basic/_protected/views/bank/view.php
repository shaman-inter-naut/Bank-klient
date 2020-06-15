<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bank */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bank', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="bank-view">

    <h4 style="text-align: center"><?= Html::encode($this->title) ?></h4>

    <p>
<!--        --><?//= Html::a('Ўгартириш', ['update', 'id' => $model->id], ['class' => 'bank btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'name',
            [
                'attribute' => 'name',
                'name' => 'НОМИ:',
            ],
        ],
    ]) ?>

</div>


<?= Html::a('Ўчириш', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
    ],
]) ?>
<?
Modal::begin([
//        'header' => '<h3>Банк қўшиш</h3>',
    'id' => 'modal',
]);
?>
    <div id="modalContent">

    </div>
<?php
Modal::end();
?>