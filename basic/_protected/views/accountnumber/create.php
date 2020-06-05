<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccountNumber */

$this->title = 'Create Account Number';
$this->params['breadcrumbs'][] = ['label' => 'Account Numbers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-number-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
