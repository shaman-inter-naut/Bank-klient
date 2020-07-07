<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\AccountNumber */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-number-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bank_branch_id')->widget(Select2::classname(), [
        'data' =>  ArrayHelper::map(\app\models\BankBranch::find()->all(),'id','mfo'),
        'language' => 'ru',
        'options' => ['placeholder' => '---Банк МФО киритинг ёки танланг---'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Банк филиаллари:');
    ?>

    <?= $form->field($model, 'account_number')->textInput([])->label('Хисоб рақам') ?>

    <?= $form->field($model, 'is_main')->radioList(['1'=>'Асосий ', '2'=>'Махсус', '3'=>'Депозит ', '4'=>'Корпоратив карта '])->label(false) ?>

    <?= $form->field($model, 'stock')->textInput([])->label('Қолдиқ') ?>

    <?= $form->field($model, 'stock_date')->widget(DateTimePicker::className(), [
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
            'format' => 'yyyy-mm-dd',
            'todayBtn' => true
        ]
    ])->label('Сана');?>


<!---->
<!--    --><?//= $form->field($model, 'bank_branch_id')->dropDownList(
//        ArrayHelper::map(\app\models\BankBranch::find()->all(),'id','short_name'),['prompt'=>'---Банкни танланг---'])->
//    label('Банк номи') ?>

    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
