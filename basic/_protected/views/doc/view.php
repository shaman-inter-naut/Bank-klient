<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Xujjat */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Xujjats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="xujjat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'file_id',
            'expence_type_id',
            'detail_date',
            'detail_account',
            'detail_inn',
            'detail_partner_unique_code',
            'detail_name',
            'detail_document_number',
            'detail_mfo',
            'detail_debet',
            'detail_kredit',
            'detail_purpose_of_payment:ntext',
            'code_currency',
            'contract_date',
            'tip_deb_kred',
            'company_account_id',
            'data_id',
            'period_id',
            'inn_id',
            'filecom_id',
            'company_unikal',
        ],
    ]) ?>

</div>
