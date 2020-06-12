<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FileInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'File Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-info-index">

    <h1><?= Html::encode("ФАЙЛЛАР") ?></h1>

    <hr style="border: 5px solid darkslategrey">

    <p>
        <?= Html::a('+', ['create'], ['class' => 'bank btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'id',
            'bank_mfo',
            'company_account',
            'company_inn',
            'file_name',
            //'file_date',
            //'data_period',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}  {update}  {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('', ['view', 'id' => $model->id], [
                            'class' => 'glyphicon glyphicon-eye-open bank',

                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('', ['update', 'id' => $model->id], [
                            'class' => 'glyphicon glyphicon-pencil bank',

                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('', ['delete', 'id' => $model->id], [
                            'class' => 'glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => 'Ўчириб юборилсинми?',
                                'method' => 'post',
                            ],
                        ]);
                    },

                ],
                ],
        ],
    ]); ?>


</div>

<?
Modal::begin([
//    'header' => '<h3>Банк қўшиш</h3>',
    'id' => 'modal',
]);
?>
<div id="modalContent">

</div>
<?php
Modal::end();
?>
