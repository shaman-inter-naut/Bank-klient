<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FileInfo */

$this->title = 'Update File Info: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'File Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="file-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
