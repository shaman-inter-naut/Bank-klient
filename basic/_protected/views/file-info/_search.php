<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FileInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'file_mfo') ?>

    <?= $form->field($model, 'file_account') ?>

    <?= $form->field($model, 'file_inn') ?>

    <?= $form->field($model, 'file_name') ?>

    <?php // echo $form->field($model, 'file_date') ?>

    <?php // echo $form->field($model, 'file_period') ?>

    <?php // echo $form->field($model, 'file_company_name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
