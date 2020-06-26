<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div  style="padding-bottom: 30px">
    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
</div>
<div class="user-create">
    <div class="col-md-4" ></div>
    <div class="col-md-4" >
        <h1><?= Html::encode($this->title) ?></h1>

<!--        <div class="col-md-5 well bs-component">-->
        <div class="well bs-component">

            <?= $this->render('_form', ['user' => $user]) ?>

        </div>
    </div>
    <div class="col-md-4" ></div>


</div>

