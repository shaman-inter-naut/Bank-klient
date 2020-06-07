<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\BankBranch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bank-branch-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_branch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mfo')->textInput() ?>

    <?= $form->field($model, 'bank_id')->dropDownList(
            ArrayHelper::map(\app\models\Bank::find()->all(),'id','name'),['prompt'=>'---Банкни танланг---'])->
        label('Банк номи') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
