<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BankBranch */

//$this->title = 'Update Bank Branch: ' . $model->id;
$this->title = '<h6>Филиални ўзгартириш</h6> ' ;
$this->params['breadcrumbs'][] = ['label' => 'Bank Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bank-branch-update">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
    <div style="text-align: center">
        <?=$this->title?>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
