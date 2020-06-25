<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bank */

$this->title = 'Банк қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-create">

    <h4  ><?= Html::encode($this->title) ?></h4>
<!--    <div style="text-align: center">-->
<!--        --><?//=$this->title?>
<!--    </div>-->
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
