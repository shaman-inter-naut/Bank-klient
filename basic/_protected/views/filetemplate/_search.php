<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FiletemplateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="filetemplate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bank_id') ?>

    <?= $form->field($model, 'in_address') ?>

    <?= $form->field($model, 'mfo_address') ?>

    <?= $form->field($model, 'hr_address') ?>

    <?php // echo $form->field($model, 'date_address') ?>

    <?php // echo $form->field($model, 'file_number_address') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
