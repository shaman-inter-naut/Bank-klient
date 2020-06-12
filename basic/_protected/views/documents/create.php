<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Documents */

$this->title = 'Create Documents';
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-create">

    <h1><?= Html::encode("Файл юклаш") ?></h1>

    <hr style="border: 5px solid darkslategrey">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
