<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use kartik\field\FieldRange;
use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;

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
            'attribute'=>'detail_date',
//            'convertFormat'=>true,
            'options' => ['placeholder' => 'Санани киритинг ...',
                'value' =>$_GET['XujjatSearch']['startDT']?$_GET['startDT'] : date("d.m.yy"),
//                'value' =>'detail_date',
            ],
            'pluginOptions' => [
                'autoclose' => true,
                'timePicker'=>true,
                'format' =>'dd.mm.yyyy'
            ]
//            ,'disabled' => $disabledField
        ])->label(false); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'endDT')->widget(DatePicker::classname(), [
            'attribute'=>'detail_date',
//            'convertFormat'=>true,
            'options' => ['placeholder' => 'Санани киритинг ...',
                'value' =>$_GET['XujjatSearch']['endDT']?$_GET['endDT'] : date("d.m.yy",strtotime('+1 days')),
//                'value' =>'detail_date',
            ],
            'pluginOptions' => [
                'autoclose' => true,
                'timePicker'=>true,
                'format' =>'dd.mm.yyyy'
            ]
//            ,'disabled' => $disabledField
        ])->label(false); ?>
    </div>


<!--    --><?//= $form->field($model, 'detail_date') ?>




    <div class="form-group">

        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
