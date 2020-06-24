<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FileInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bank_mfo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_period')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
