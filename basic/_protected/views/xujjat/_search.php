<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use kartik\field\FieldRange;
use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;
//use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\XujjatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="xujjat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


   
    <div class="col-md-4">
        <?= $form->field($model, 'startDT')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Бошлаш вақти(Дан...)', 
                // 'value' => date('Y-m-d')
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' =>'yyyy-mm-dd'
                ]
            ])->label(false); ?>
        </div>
        <div class="col-md-4">
        <?= $form->field($model, 'endDT')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Бошлаш вақти(...Гача)', 
                // 'value' => date('Y-m-d')
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' =>'yyyy-mm-dd'
                ]
            ])->label(false); ?>
        </div>


<!--    --><?//= $form->field($model, 'detail_date') ?>




    <div class="form-group">

        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
