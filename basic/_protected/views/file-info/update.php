<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FileInfo */

$this->title = 'Ўзгартириш: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'File Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ўзгартириш';
?>
<div class="file-info-update">

    <h1><?= Html::encode("Маълумотларни ўзгартириш") ?></h1>

    <hr style="border: 5px solid darkslategrey">

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
