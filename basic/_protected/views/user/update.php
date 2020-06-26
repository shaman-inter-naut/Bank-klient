<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$this->title = Yii::t('app', 'Update User') . ': ' . $user->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->username, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div  style="padding-bottom: 30px">
    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
</div>
<div class="user-update">
    <div class="col-md-4" ></div>
    <div class="col-md-4" >

        <h1><?= Html::encode($this->title) ?></h1>

        <div class=" well bs-component">

            <?= $this->render('_form', ['user' => $user]) ?>

        </div>
    </div>
    <div class="col-md-4" ></div>


</div>
