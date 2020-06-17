<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FileInfo */

$this->title = 'Create File Info';
$this->params['breadcrumbs'][] = ['label' => 'File Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-info-create">

    <h1 align="center"><?= Html::encode("Файл юклаш") ?></h1>

    <hr style="border: 5px solid darkslategrey">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
