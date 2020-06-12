<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FileInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'file')->fileInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'bank_mfo')->textInput(['maxlength' => true, 'value' => $fayl->bank_mfo])->label(false)->error(false) ?>

    <?= $form->field($model, 'company_account')->textInput(['maxlength' => true, 'value' => $fayl->company_account])->label(false)->error(false) ?>

    <?= $form->field($model, 'company_inn')->textInput(['maxlength' => true, 'value' => $company_inn])->label(false)->error(false) ?>

    <?= $form->field($model, 'file_name')->textInput(['maxlength' => true, 'value' => $fayl->file_name])->label(false)->error(false) ?>

    <?= $form->field($model, 'file_date')->textInput(['maxlength' => true, 'value' => $fayl->file_date])->label(false)->error(false) ?>

    <?= $form->field($model, 'data_period')->textInput(['maxlength' => true, 'value' => $fayl->data_period])->label(false)->error(false) ?>

    <div class="form-group">
        <hr style="border: 2px solid silver">
        <?= Html::submitButton('Ўзгаришларни сақлаш', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
