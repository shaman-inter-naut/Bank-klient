<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="descriptison">
        <meta content="GM, Корхоналар, Банклар, Хисоб рақамлар, " name="keywords">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="icon" type="image/png" sizes="32x32" href="/themes/logo.jpg">
        <link rel="icon" type="image/png" sizes="96x96" href="/themes/logo.jpg">
        <link rel="icon" type="image/png" sizes="16x16" href="/themes/logo.jpg">
        <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href="themes/day/assets/css/style.css" rel="stylesheet">


        <!--<link rel="stylesheet" href="../../web/new.css"> -->

        <?php $this->head() ?>
        <style>
            .material-icons {vertical-align:-5%}
        </style>
    </head>
    <body>
    <?php $this->beginBody() ?>
<!--    <div class="wrap">-->
<!--        --><?php
//        $active = ['active' => in_array(\Yii::$app->controller->id, ['tickets'])];
//        NavBar::begin([
//            'brandLabel' => "Банк-клиент тизими",
//            'brandUrl' => Yii::$app->homeUrl,
//            'options' => [
//                'class' => 'navbar-default navbar-fixed-top',
//            ],
//        ]);
//
//        // everyone can see Home page
////        $menuItems[] = ['label' => Yii::t('app', 'Bosh sahifa'), 'url' => ['site/index'],$active];
////        $menuItems[] = ['label' => Yii::t('app', 'Файл'), 'url' => ['file-info/index'],$active];
//        $menuItems[] = [
//                        'label' => 'Файл',
//                          'items' => [
//                              ['label' => 'Файллар', 'url' => '/file-info/index'],
//                              '<li class="divider"></li>',
////                              ['label' => 'Умумий файллар', 'url' => '/document/index'],
////                              '<li class="divider"></li>',
//                              ['label' => 'Умумий файллар', 'url' => '/xujjat/index'],
//                              '<li class="divider"></li>',
//                              ['label' => 'expence_types', 'url' => '/expence-types/index'],
//                              '<li class="divider"></li>',
//                              ['label' => 'to Ms Excel', 'url' => '/file-info/to-excel'],
//                              '<li class="divider"></li>',
//                          ]
//                 ];
//
//        $menuItems[] =
//            [
//                'label' => 'Тахрир',
//                'items' => [
    //                    ['label' => 'Банклар', 'url' => '/bank/index'],
//                    '<li class="divider"></li>',
//                    ['label' => 'Корхоналар', 'url' => '/company/index'],
//                    '<li class="divider"></li>',
//
//                    ['label' => 'Валюта', 'url' => '/currency/index'],
//                    '<li class="divider"></li>',
////                    ['label' => 'Шаблонлар', 'url' => '/filetemplate/index'],
////                    '<li class="divider"></li>',
//
//
////                    ['label' => 'Файллар', 'url' => '/files/index'],
////                    '<li class="divider"></li>',
////                    ['label' => 'Хужжатлар', 'url' => '/documents/index'],
////                    '<li class="divider"></li>',
//
//
//                ],
//            ];
//
//
//        $menuItems[] =
//            [
//                'label' => 'Маълумотлар',
//                'items' => [
////                    ['label' => 'Банклар', 'url' => '/bank/index'],
////                    '<li class="divider"></li>',
//                    ['label' => 'Банклар ва филиаллар', 'url' => '/bank/info'],
//                    '<li class="divider"></li>',
//
//
////                    ['label' => 'Корхоналар', 'url' => '/company/index'],
////                    '<li class="divider"></li>',
//
//                    ['label' => 'Корхоналар ва хисоб рақамлар', 'url' => '/company/info'],
//                    '<li class="divider"></li>',
//                    ['label' => 'Шартномалар', 'url' => '/contracts/index'],
//                    '<li class="divider"></li>',
//
////                    ['label' => 'Korxona xisob raqamlari', 'url' => '/site/xr'],
////                    '<li class="divider"></li>',
//
////                    ['label' => 'Shartnomalar', 'url' => '/site/shartnoma'],
////                    '<li class="divider"></li>',
//
////                    ['label' => 'Hujjatlar / Provodkalar', 'url' => '/site/hujjat'],
////                    '<li class="divider"></li>',
//
////                    ['label' => 'Fayllar', 'url' => '/site/fayl'],
////                    '<li class="divider"></li>',
//
////                    ['label' => 'Valyutalar', 'url' => '/site/valyuta'],
////                    '<li class="divider"></li>',
//
////                    ['label' => 'Hisobotlar', 'url' => '/site/hisobot'],
//                ],
//            ];
//
//        // we do not need to display About and Contact pages to employee+ roles
//        if (!Yii::$app->user->can('employee')) {
////        $menuItems[] = ['label' => Yii::t('app', 'Biz haqimizda'), 'url' => ['/site/about']];
////        $menuItems[] = ['label' => Yii::t('app', 'Aloqa'), 'url' => ['/site/contact']];
//        }
//
//        // display Users to admin+ roles
//        if (Yii::$app->user->can('admin')){
//            $menuItems[] = ['label' => Yii::t('app', 'Админ'), 'url' => ['/user/view', 'id' => Yii::$app->user->id]];
//            $menuItems[] = ['label' => Yii::t('app', 'Фойдаланувчилар'), 'url' => ['/user/index']];
//
//        }
//
//        // display Logout to logged in users
//        if (!Yii::$app->user->isGuest) {
//            $menuItems[] = [
//                'label' => Yii::t('app', 'Чиқиш'). ' (' . Yii::$app->user->identity->username . ')',
//                'url' => ['/site/logout'],
//                'linkOptions' => ['data-method' => 'post']
//            ];
//        }
//
//        // display Signup and Login pages to guests of the site
//        if (Yii::$app->user->isGuest) {
//            $menuItems[] = ['label' => Yii::t('app', 'Рўйхатдан ўтиш'), 'url' => ['/site/signup']];
//            $menuItems[] = ['label' => Yii::t('app', 'Кириш'), 'url' => ['/site/login']];
//        }
//
//        echo Nav::widget([
//            'options' => ['class' => 'navbar-nav navbar-right'],
//            'items' => $menuItems,
//        ]);
//
//        NavBar::end();
//        ?>
<!---->
<!--        <div class="container">-->
<!--            --><?//= Breadcrumbs::widget([
//                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//            ]) ?>
<!--            --><?//= Alert::widget() ?>
<!--            --><?//= $content ?>
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <footer class="footer">-->
<!--        <div class="container">-->
<!--            <p class="pull-left">&copy; --><?//= "UzAuto Motors" ?><!-- --><?//= date('Y') ?><!--</p>-->
<!--            <p class="pull-right">--><?//= "" ?><!--</p>-->
<!--        </div>-->
<!--    </footer>-->

<!--    <div class="--><?//=((Yii::$app->controller->action->id=="site")?'':'container')?><!--">-->

        <?=$content?>
<!--    </div>-->
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>