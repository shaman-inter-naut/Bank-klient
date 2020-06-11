<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Files */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_inn')->textInput()->label('Корхона ИННси') ?>

    <?= $form->field($model, 'bank_mfo')->textInput()->label('Банк Мфо') ?>

    <?= $form->field($model, 'company_account_number')->textInput()->label('Корхона Х/Р') ?>

    <?= $form->field($model, 'file_date')->textInput(['maxlength' => true])->label('Вақти') ?>

    <?= $form->field($model, 'code_currency')->textInput()->label('Валюта коди') ?>

    <?= $form->field($model, 'period')->textInput()->label('Ўтказма') ?>

    <?= $form->field($model, 'first_sum')->textInput()->label('Бош сумма') ?>

    <?= $form->field($model, 'last_sum')->textInput()->label('Охирги сумма') ?>

    <?= $form->field($model, 'debit')->textInput()->label('Кирим') ?>

    <?= $form->field($model, 'credit')->textInput()->label('Чиқим') ?>

<!--    --><?//= $form->field($model, 'account_number_id')->textInput()->label(false) ?>

<!--    --><?//= $form->field($model, 'currency_id')->textInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
