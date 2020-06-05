<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banklar';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>


</style>
<div class="bank-index">

    <div class="info" style="margin-bottom: 10px; padding: 5px;">
        <p><strong style=""><h1><?= Html::encode($this->title) ?></h1></strong></p>
    </div>



<!--    <p>-->
<!--        --><?//= Html::a(Yii::t('app', '+'), ['create'], ['title'=>'Yangi foydalanuvchi qo`shish', 'class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',       // Showing ni yo`qotish uchun
        'columns' => [
            //    ['class' => 'yii\grid\SerialColumn'],

               [
                'attribute' => 'id',
                'header' => 'ID:',
                'filter'=>false,
                'options' => ['width' => '10', 'filterModel' => null]
                ],
            [
                'attribute' => 'name',
                'header' => 'Nomi:',
//                'filter'=>false,
//                'options' => ['width' => '80', 'filterModel' => null]
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>Html::a(Yii::t('yii', 'Қўшиш'), ['create'], ['title'=>'Янги банк номини киритиш', 'class' => 'btn btn-danger']),
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
                            ]);
                    },
                    'my_action2' => function ($url, $model) {
                        return Html::a('<span class="material-icons">create</span>', $url,
                            [
                                'title' => Yii::t('app', 'Тахрирлаш'),
                            ]);
                    },
                    'my_action3' => function ($url, $model) {
                        return Html::a('<span class="material-icons">delete_forever</span>', $url,
                            [
                                'title' => Yii::t('app', 'Ўчириш'),
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


</div>
<style type="text/css">

</style>