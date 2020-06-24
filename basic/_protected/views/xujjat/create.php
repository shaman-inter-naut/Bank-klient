<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Xujjat */

$this->title = 'Create Xujjat';
$this->params['breadcrumbs'][] = ['label' => 'Xujjats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xujjat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
