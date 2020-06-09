<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccountNumber */

$this->title = 'Хисоб рақам қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Account Numbers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-number-create">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
    <div style="text-align: center">
        <?=$this->title?>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
