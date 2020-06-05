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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => "Bank-klient tizimi kirim-chiqim hisobotlari",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);

    // everyone can see Home page
    $menuItems[] = ['label' => Yii::t('app', 'Bosh sahifa'), 'url' => ['/site/index']];
    $menuItems[] = ['label' => Yii::t('app', 'Bank'), 'url' => ['/bank/index']];

    $menuItems[] =
        [
            'label' => 'Ma`lumotlar',
            'items' => [
                ['label' => 'Banklar', 'url' => '/site/bank'],
                '<li class="divider"></li>',
//                '<li class="dropdown-header">Dropdown Header</li>',
                ['label' => 'Bank filiallari', 'url' => '/site/bank-filial'],
                '<li class="divider"></li>',
//                '<li class="dropdown-header">Dropdown Header</li>',
                ['label' => 'Korxonalar', 'url' => '/site/korxona'],
                '<li class="divider"></li>',
//                '<li class="dropdown-header">Dropdown Header</li>',
                ['label' => 'Korxona xisob raqamlari', 'url' => '/site/xr'],
                '<li class="divider"></li>',
//                '<li class="dropdown-header">Dropdown Header</li>',
                ['label' => 'Shartnomalar', 'url' => '/site/shartnoma'],
                '<li class="divider"></li>',
//                '<li class="dropdown-header">Dropdown Header</li>',
                ['label' => 'Hujjatlar / Provodkalar', 'url' => '/site/hujjat'],
                '<li class="divider"></li>',
//                '<li class="dropdown-header">Dropdown Header</li>',
                ['label' => 'Fayllar', 'url' => '/site/fayl'],
                '<li class="divider"></li>',
//                '<li class="dropdown-header">Dropdown Header</li>',
                ['label' => 'Valyutalar', 'url' => '/site/valyuta'],
                '<li class="divider"></li>',
//                '<li class="dropdown-header">Dropdown Header</li>',
                ['label' => 'Hisobotlar', 'url' => '/site/hisobot'],
            ],
        ];

    // we do not need to display About and Contact pages to employee+ roles
    if (!Yii::$app->user->can('employee')) {
//        $menuItems[] = ['label' => Yii::t('app', 'Biz haqimizda'), 'url' => ['/site/about']];
//        $menuItems[] = ['label' => Yii::t('app', 'Aloqa'), 'url' => ['/site/contact']];
    }

    // display Users to admin+ roles
    if (Yii::$app->user->can('admin')){
        $menuItems[] = ['label' => Yii::t('app', 'Admin'), 'url' => ['/user/view', 'id' => Yii::$app->user->id]];
        $menuItems[] = ['label' => Yii::t('app', 'Foydalanuvchilar'), 'url' => ['/user/index']];

    }
    
    // display Logout to logged in users
    if (!Yii::$app->user->isGuest) {
        $menuItems[] = [
            'label' => Yii::t('app', 'Chiqish'). ' (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }

    // display Signup and Login pages to guests of the site
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('app', 'Ro`yxatdan o`tish'), 'url' => ['/site/signup']];
        $menuItems[] = ['label' => Yii::t('app', 'Kirish'), 'url' => ['/site/login']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= "UzAuto Motors" ?> <?= date('Y') ?></p>
        <p class="pull-right"><?= "" ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
