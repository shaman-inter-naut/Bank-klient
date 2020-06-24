<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FileInfo */

$this->title = 'Create File Info';
$this->params['breadcrumbs'][] = ['label' => 'File Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
