<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true],['required'=>true])->label('Корхона тўлиқ номи') ?>

    <?= $form->field($model, 'short_name')->textInput(['maxlength' => true])->label('Корхона номи') ?>

    <?= $form->field($model, 'inn')->textInput(['type'=>'number'])->label('Инн') ?>

    <?= $form->field($model, 'accaunt_begin')->textInput([])->label('Хисоб рақам бошланиши') ?>

    <?= $form->field($model, 'unical_code')->textInput(['required'=>true])->label('Униал код') ?>

    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
