<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Contracts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contracts-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'first_company_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'second_company_id')->textInput() ?>

    <?= $form->field($model, 'first_company_id')->dropDownList(
        ArrayHelper::map(\app\models\Company::find()->all(),'id','name'),['prompt'=>'---Корхонани танланг---'])->
    label('Корхонани номи') ?>

    <?= $form->field($model, 'second_company_id')->dropDownList(
        ArrayHelper::map(\app\models\Company::find()->all(),'id','name'),['prompt'=>'---Корхонани танланг---'])->
    label('Корхонани номи') ?>

    <?= $form->field($model, 'contract_number')->textInput(['required'=>true]) ?>




<!--    --><?//= $form->field($model, 'contract_date')->textInput() ?>

    <?= $form->field($model, 'contract_date')->widget(DateTimePicker::className(), [
        'language' => 'ru',
//        'size' => 'ms',
        'template' => '{input}',
//        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'inline' => false,
        'clientOptions' => [
            'startView' => 2,
            'minView' => 2,
            'maxView' => 0,
            'autoclose' => false,
            'linkFormat' => false,
             'format' => 'd.mm.yyyy',
            'todayBtn' => true
        ]
    ]);?>



    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
