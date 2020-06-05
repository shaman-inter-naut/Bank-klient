<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FilesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_inn') ?>

    <?= $form->field($model, 'bank_mfo') ?>

    <?= $form->field($model, 'company_account_number') ?>

    <?= $form->field($model, 'file_date') ?>

    <?php // echo $form->field($model, 'code_currency') ?>

    <?php // echo $form->field($model, 'period') ?>

    <?php // echo $form->field($model, 'first_sum') ?>

    <?php // echo $form->field($model, 'last_sum') ?>

    <?php // echo $form->field($model, 'debit') ?>

    <?php // echo $form->field($model, 'credit') ?>

    <?php // echo $form->field($model, 'account_number_id') ?>

    <?php // echo $form->field($model, 'currency_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
