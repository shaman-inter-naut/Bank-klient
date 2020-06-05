<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Filetemplate */

$this->title = 'Create Filetemplate';
$this->params['breadcrumbs'][] = ['label' => 'Filetemplates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filetemplate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
