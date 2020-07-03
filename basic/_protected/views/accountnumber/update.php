<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccountNumber */

//$this->title = 'Update Account Number: ' . $model->id;
$this->title = 'Ўзгартириш: ';
$this->params['breadcrumbs'][] = ['label' => 'Account Numbers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="account-number-update">

    <h5><?= Html::encode($this->title) ?></h5>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
