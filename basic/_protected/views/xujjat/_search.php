<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use kartik\field\FieldRange;

/* @var $this yii\web\View */
/* @var $model app\models\XujjatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="xujjat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>





<!--    --><?//= $form->field($model, 'detail_date') ?>
    <?= $form->field($model, 'detail_date')->widget(FieldRange::className(), [
        'language' => 'ru',
        'template' => '{input}',
        'attribute' => 'detail_date',
        'inline' => false,
        'clientOptions' => [
            'startView' => 2,
            'minView' => 2,
            'maxView' => 0,
            'autoclose' => true,
            'linkFormat' => false,
            'format' => 'd.mm.yyyy',
            'todayBtn' => true,
            'clearBtn' => true

        ]
    ]);?>


    <div class="form-group">

        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
