<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Files */

$this->title = 'Файл қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-create">

    <h4 style="text-align: center"><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
