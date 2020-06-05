<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BankBranch */

$this->title = 'Create Bank Branch';
$this->params['breadcrumbs'][] = ['label' => 'Bank Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-branch-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
