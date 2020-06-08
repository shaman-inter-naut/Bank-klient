<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\AccountNumber */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-number-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account_number')->textInput() ?>

<!--    --><?//= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'company_id')->dropDownList(
        ArrayHelper::map(\app\models\Company::find()->all(),'id','name'),['prompt'=>'---Корхонани танланг---'])->
    label('Корхона номи') ?>

<!--    --><?//= $form->field($model, 'bank_branch_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'bank_branch_id')->dropDownList(
//        ArrayHelper::map(\app\models\BankBranch::find()->all(),'id','name'),['prompt'=>'---Банкни танланг---'])->
//    label('Банк номи') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
