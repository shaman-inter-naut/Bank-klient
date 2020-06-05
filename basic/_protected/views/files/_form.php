<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Files */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_inn')->textInput() ?>

    <?= $form->field($model, 'bank_mfo')->textInput() ?>

    <?= $form->field($model, 'company_account_number')->textInput() ?>

    <?= $form->field($model, 'file_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code_currency')->textInput() ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <?= $form->field($model, 'first_sum')->textInput() ?>

    <?= $form->field($model, 'last_sum')->textInput() ?>

    <?= $form->field($model, 'debit')->textInput() ?>

    <?= $form->field($model, 'credit')->textInput() ?>

    <?= $form->field($model, 'account_number_id')->textInput() ?>

    <?= $form->field($model, 'currency_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
