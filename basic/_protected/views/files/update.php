<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Files */

$this->title = 'Ўзгартириш: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="files-update">

    <h4 style="text-align: center"><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
