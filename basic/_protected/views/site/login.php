<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div  style="padding-bottom: 30px">-->
<!--    --><?//=Yii::$app->controller->renderPartial("//layouts/header")?>
<!--</div>-->
<!--<div style="background-image: url('/themes/123.gif'); height: 100%" >-->
<div style="background-color: #3f4079; height: 100%" >


<div style="padding-top: 150px;" class="container site-login">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
    <div class="col-md-4" ></div>
    <div class="col-md-4" >
        <div class=" well bs-component">
<!--            <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

            <h3 style="text-align: center">Банк-клиент тизими</h3>
            <h5 style="text-align: center"><?= Yii::t('app', 'Илтимос, логин ва паролни киритинг:') ?></h5>
            <hr>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?php //-- use email or username field depending on model scenario --// ?>
            <?php if ($model->scenario === 'lwe'): ?>

                <?= $form->field($model, 'email')->input('email',
                    ['placeholder' => Yii::t('app', 'e-mail киритинг'), 'autofocus' => true])->label(false)->error(false) ?>

            <?php else: ?>

                <?= $form->field($model, 'username')->textInput(
                    ['placeholder' => Yii::t('app', 'Фойдаланувчини киритинг'), 'autofocus' => true])->label(false)->error(false) ?>

            <?php endif ?>

            <?= $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('app', 'Паролни киритинг')])->label(false)->error(false) ?>

            <?= $form->field($model, 'rememberMe')->checkbox()->label('Эслаб қолиш') ?>

  <!--          <div style="color:#999;margin:1em 0">
                <?= Yii::t('app', 'If you forgot your password you can') ?>
                <?= Html::a(Yii::t('app', 'reset it'), ['site/request-password-reset']) ?>.
            </div>
-->
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Кириш'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
    <div class="col-md-4" ></div>

</div>
</div>