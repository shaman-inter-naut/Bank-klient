<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use app\models\Company;
use yii\helpers\ArrayHelper;
//$names = Company::find()->all();
//$name = $names->short_name;
//$name = ArrayHelper::map($name,'id','short_name');

/* @var $this yii\web\View */
/* @var $model app\models\Contracts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contracts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_company')->textInput() ?>

    <?= $form->field($model, 'second_company')->textInput() ?>

    <?= $form->field($model, 'contract_number')->textInput() ?>

    <?= $form->field($model, 'contract_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_id')->dropDownList(
            ArrayHelper::map(\app\models\Company::find()->all(),
                'id',
                'short_name'),
        [
            'prompt'=>'---Корхонани танланг---'
        ]
    )->label( 'Корхона номи')
         ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
