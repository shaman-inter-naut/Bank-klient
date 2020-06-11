<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Files */

$this->title = 'Батафсил '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="files-view">

    <h4 style="text-align: center"><?= Html::encode($this->title) ?></h4>

    <p>
<!--        --><?//= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company_inn',
            'bank_mfo',
            'company_account_number',
            'file_date',
            'code_currency',
            'period',
            'first_sum',
            'last_sum',
            'debit',
            'credit',
//            'account_number_id',
//            'currency_id',
        ],
    ]) ?>
    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>

</div>
