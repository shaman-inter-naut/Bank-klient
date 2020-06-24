<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Documents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'file_id')->textInput() ?>

    <?= $form->field($model, 'detail_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail_inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail_document_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail_mfo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail_debet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail_kredit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail_purpose_of_payment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'code_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contract_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tip_deb_kred')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
