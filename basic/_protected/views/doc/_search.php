<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="xujjat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'file_id') ?>

    <?= $form->field($model, 'expence_type_id') ?>

    <?= $form->field($model, 'detail_date') ?>

    <?= $form->field($model, 'detail_account') ?>

    <?php // echo $form->field($model, 'detail_inn') ?>

    <?php // echo $form->field($model, 'detail_partner_unique_code') ?>

    <?php // echo $form->field($model, 'detail_name') ?>

    <?php // echo $form->field($model, 'detail_document_number') ?>

    <?php // echo $form->field($model, 'detail_mfo') ?>

    <?php // echo $form->field($model, 'detail_debet') ?>

    <?php // echo $form->field($model, 'detail_kredit') ?>

    <?php // echo $form->field($model, 'detail_purpose_of_payment') ?>

    <?php // echo $form->field($model, 'code_currency') ?>

    <?php // echo $form->field($model, 'contract_date') ?>

    <?php // echo $form->field($model, 'tip_deb_kred') ?>

    <?php // echo $form->field($model, 'company_account_id') ?>

    <?php // echo $form->field($model, 'data_id') ?>

    <?php // echo $form->field($model, 'period_id') ?>

    <?php // echo $form->field($model, 'inn_id') ?>

    <?php // echo $form->field($model, 'filecom_id') ?>

    <?php // echo $form->field($model, 'company_unikal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
