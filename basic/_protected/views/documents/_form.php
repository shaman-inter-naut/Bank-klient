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

    <?= $form->field($model, 'company_id')->dropDownList(
        ArrayHelper::map(\app\models\Company::find()->all(),'id','short_name'),['prompt'=>'---Корхонани танланг---'])->
    label('Корхонани номи') ?>

    <?= $form->field($model, 'inn_company')->dropDownList(
        ArrayHelper::map(\app\models\Company::find()->all(),'id','inn'),['prompt'=>'---Inn танланг---'])->
    label('INN') ?>


    <?= $form->field($model, 'mfo_bank')->textInput() ?>

    <?= $form->field($model, 'account_number_company')->textInput() ?>

<!--    --><?//= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
        'language' => 'ru',
        'template' => '{input}',
        'inline' => false,
        'clientOptions' => [
            'startView' => 2,
            'minView' => 2,
            'maxView' => 0,
            'autoclose' => false,
            'linkFormat' => false,
            'format' => 'dd-M-yyyy',
            'todayBtn' => true
        ]
    ]);?>



    <?= $form->field($model, 'document_number')->textInput() ?>

    <?= $form->field($model, 'mfo_branch')->textInput() ?>

    <?= $form->field($model, 'inn_branch')->textInput() ?>

    <?= $form->field($model, 'name_branch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_number_branch')->textInput() ?>

    <?= $form->field($model, 'purpose_branch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code_currency')->textInput() ?>

    <?= $form->field($model, 'kirim')->textInput() ?>

    <?= $form->field($model, 'chiqim')->textInput() ?>

    <?= $form->field($model, 'tip_k_ch')->dropDownList([
        '0' => 'kirim',
        '1' => 'chiqim',

    ],['prompt'=>'---Tip танланг---']); ?>


<!--    --><?//= $form->field($model, 'contract_date')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'contract_date')->widget(DateTimePicker::className(), [
        'language' => 'ru',
        'template' => '{input}',
        'inline' => false,
        'clientOptions' => [
            'startView' => 2,
            'minView' => 2,
            'maxView' => 0,
            'autoclose' => false,
            'linkFormat' => false,
            'format' => 'dd-M-yyyy',
            'todayBtn' => true
        ]
    ]);?>


    <?= $form->field($model, 'contract_number')->textInput() ?>

<!--    --><?//= $form->field($model, 'contracts_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'currency_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'account_number_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'bank_branch_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'company_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
