<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\BankBranch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bank-branch-form">

    <?php $form = ActiveForm::begin([
//            'header' => 'Банк филиалини кошиш',
    ]); ?>

    <?= $form->field($model, 'short_name')->textInput()->label('Филиал номи') ?>

    <?= $form->field($model, 'name_branch')->textInput(['maxlength' => true])->label('Филиал тўлиқ номи') ?>

    <?= $form->field($model, 'mfo')->textInput([])->label('МФО') ?>



<!--    --><?//= $form->field($model, 'bank_id')->dropDownList(
//            ArrayHelper::map(\app\models\Bank::find()->all(),'id','name'),['prompt'=>'---Банкни танланг---'])->
//        label('Банк номи') ?>

    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
