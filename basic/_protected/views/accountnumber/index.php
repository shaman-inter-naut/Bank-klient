<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountNumberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Numbers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-number-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Account Number', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'account_number',
            'company_id',
            'bank_branch_id',

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