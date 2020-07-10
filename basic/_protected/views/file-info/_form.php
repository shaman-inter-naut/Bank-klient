<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FileInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        // получаем всех авторов
        $bank = \app\models\Bank::find()->where(['in', 'template', [1,2,3]])->all();
        // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
        $items = ArrayHelper::map($bank,'id','name');
        $params = [
            'prompt' => '------------------------------'
        ];
        echo $form->field($model, 'bank_id')->dropDownList($items,$params)->label('Банк номини танланг:');
        echo "<br>";
    ?>

    <?= $form->field($model, 'file')->fileInput(['required'=>true])->label(false)->error(false) ?>

    <?= $form->field($model, 'bank_mfo')->hiddenInput(['maxlength' => true, 'value' => $fileMFO])->label(false)->error(false) ?>

    <?= $form->field($model, 'company_account')->hiddenInput(['maxlength' => true, 'value' => $fileACC])->label(false)->error(false) ?>

    <?= $form->field($model, 'company_inn')->hiddenInput(['maxlength' => true, 'value' => $fileINN])->label(false)->error(false) ?>

    <?= $form->field($model, 'file_name')->hiddenInput(['maxlength' => true, 'value' => $fileName])->label(false)->error(false) ?>

    <?= $form->field($model, 'file_date')->hiddenInput(['maxlength' => true, 'value' => $fileINTER])->label(false)->error(false) ?>

    <?= $form->field($model, 'data_period_start')->hiddenInput(['maxlength' => true, 'value' => $fileINTER])->label(false)->error(false) ?>

    <?= $form->field($model, 'data_period_end')->hiddenInput(['maxlength' => true, 'value' => $fileINTER])->label(false)->error(false) ?>

    <div class="form-group">
        <hr style="border: 2px solid silver">
        <?= Html::submitButton('Юклаш', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
