<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Filetemplate */

$this->title = 'Update Filetemplate: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Filetemplates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="filetemplate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
