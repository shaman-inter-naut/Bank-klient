<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Filetemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="filetemplate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bank_id')->textInput() ?>

    <?= $form->field($model, 'in_address')->textInput() ?>

    <?= $form->field($model, 'mfo_address')->textInput() ?>

    <?= $form->field($model, 'hr_address')->textInput() ?>

    <?= $form->field($model, 'date_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_number_address')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
