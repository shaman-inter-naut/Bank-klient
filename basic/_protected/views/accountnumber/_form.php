<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\AccountNumber */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-number-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account_number')->textInput([
            'type'=>'number'
    ])->label('Хисоб рақам') ?>

    <?= $form->field($model, 'bank_branch_id')->widget(Select2::classname(), [
        'data' =>  ArrayHelper::map(\app\models\BankBranch::find()->all(),'id','short_name'),
        'language' => 'ru',
        'options' => ['placeholder' => '---Банкни танланг---'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
<!---->
<!--    --><?//= $form->field($model, 'bank_branch_id')->dropDownList(
//        ArrayHelper::map(\app\models\BankBranch::find()->all(),'id','short_name'),['prompt'=>'---Банкни танланг---'])->
//    label('Банк номи') ?>

    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
