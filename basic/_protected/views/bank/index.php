<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Банклар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div  style="padding-bottom: 30px">
    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
</div>

<?//=$header?>
<div  class="container bank-index">

    <div class="info" style="margin-bottom: 10px; padding: 5px;">
        <p><strong style=""><h1><?= Html::encode($this->title) ?></h1></strong></p>
        <?//= Html::a('+', ['create', 'id' => $model->id], ['class' => 'bank btn btn-success']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',       // Showing ni yo`qotish uchun
        'columns' => [
            //    ['class' => 'yii\grid\SerialColumn'],

               [
                'attribute' => 'id',
                'header' => '№:',
                'filter'=>false,
                'options' => ['width' => '10', 'filterModel' => null]
                ],
            [
                'attribute' => 'name',
                'header' => 'НОМИ:',
//                'filter'=>false,
//                'options' => ['width' => '80', 'filterModel' => null]
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>Html::a(Yii::t('yii', 'Қўшиш'), ['create'], ['title'=>'Янги банк номини киритиш', 'class' => 'btn btn-danger bank']),
                'headerOptions' => ['width' => '10'],
               // 'template' => '{view}  {update}  {delete}',
                'template' => '{my_action} {my_action2} {my_action3}',

                // qo`shimcha button qoshish

//                'template' => '{my_action}',

                'buttons' => [
                    'my_action' => function ($url, $model) {
                        return Html::a('<span class="material-icons">visibility</span>', $url,
                            [
                                'title' => Yii::t('app', 'Кўриш'),
                                'class' => 'bank'
                            ]);
                    },
                    'my_action2' => function ($url, $model) {
                        return Html::a('<span class="material-icons">create</span>', $url,
                            [
                                'title' => Yii::t('app', 'Тахрирлаш'),
                                'class' => 'bank'
                            ]);
                    },
                    'my_action3' => function ($url, $model) {
                        return Html::a('delete_forever', ['/bank/delete', 'id' => $model->id], [
                            'class' => 'material-icons',
                            'data' => [
                                'confirm' => 'Ўчириб юборилсинми?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'my_action4' => function ($url, $model) {
                        return Html::a('<span class="material-icons">add</span>', $url,
                            [
                                'title' => Yii::t('app', 'Қўшиш'),
                            ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'my_action') {
                        return Url::to(['bank/view','id' => $model->id]);
                    }
                    if ($action === 'my_action2') {
                        return Url::to(['bank/update','id' => $model->id]);
                    }
                    if ($action === 'my_action3') {
                        return Url::to(['bank/delete','id' => $model->id]);
                    }
                    if ($action === 'my_action4') {
                        return Url::to(['bank/create']);
                    }
                }



                // END qo`shimcha button qoshish

            ],
        ],
    ]); ?>


    <?
    Modal::begin([
//        'header' => '<h3>Банк қўшиш</h3>',
        'id' => 'modal',
    ]);
    ?>
    <div id="modalContent">

    </div>
    <?php
    Modal::end();
    ?>

</div>
<style type="text/css">

</style>