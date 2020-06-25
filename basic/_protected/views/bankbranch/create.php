<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BankBranch */

$this->title = $id. 'Банк филиалини қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Bank Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-branch-create">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
    <div style="text-align: center">
        <?=$this->title?>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
