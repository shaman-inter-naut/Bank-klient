<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BankBranchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bank Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-branch-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bank Branch', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name_branch',
            'mfo',
            'bank_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<style type="text/css">
    thead  tr {
        background-color: #4CAF50
    }
    thead {
        color: white
    }
    thead tr a {
        color: white
    }
</style>