<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Documents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documents-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'inn_company')->textInput() ?>

    <?= $form->field($model, 'file')->fileInput()->label(false) ?>

    <?= $form->field($model, 'inn_company')->hiddenInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'mfo_bank')->hiddenInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'account_number_company')->hiddenInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'date')->hiddenInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'document_number')->hiddenInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'mfo_branch')->hiddenInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'inn_branch')->hiddenInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'name_branch')->hiddenInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'account_number_branch')->hiddenInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'purpose_branch')->hiddenInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'code_currency')->hiddenInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'kirim')->hiddenInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'chiqim')->hiddenInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'tip_k_ch')->hiddenInput()->label(false)->error(false) ?>

    <?= $form->field($model, 'contract_date')->hiddenInput()->label(false)->error(false) ?>


    <?= $form->field($model, 'contract_number')->hiddenInput()->label(false)->error(false) ?>

<!--    --><?//= $form->field($model, 'contracts_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'currency_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'account_number_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'bank_branch_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'company_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>




    <div class="form-group">
        <hr style="border: 2px solid silver">
        <?= Html::submitButton('Yuklash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
