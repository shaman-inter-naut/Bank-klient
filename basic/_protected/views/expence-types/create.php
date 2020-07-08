<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ExpenceTypes */

$this->title = 'Харажатлар тури қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Expence Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expence-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
