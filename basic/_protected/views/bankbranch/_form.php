<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BankBranch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bank-branch-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_branch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mfo')->textInput() ?>

    <?= $form->field($model, 'bank_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
