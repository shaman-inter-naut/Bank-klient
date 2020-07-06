<?
use yii\helpers\Url;
use yii\helpers\Html;
?>
<link href="../../../themes/day/assets/css/style.css" rel="stylesheet">
<!-- ======= Header ======= -->

<header id="header" style="background-color: #52af50; ">
    <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a style="font-size: 20px" href="<?=Url::home()?>">Банк-клиент тизими</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav class="nav-menu d-none d-lg-block">
            <ul>
<!--                <li class="active"><a href="index.html">Home</a></li>-->
                <li class="drop-down"><a>Тахрир</a>
                    <ul>
                        <li><a href="<?=Url::to('/bank/index')?>">Банклар</a></li>
                        <li><a href="<?=Url::to('/company/index')?>">Корхоналар</a></li>
                        <li><a href="<?=Url::to('/currency/index')?>">Валюта</a></li>
                    </ul>
                </li>
                <li class="drop-down"><a>Файл</a>
                    <ul>
                        <li><a href="<?=Url::to('/file-info/index')?>">Файллар</a></li>
                        <li><a href="<?=Url::to('/xujjat/table')?>">Барча проводкалар</a></li>
                        <li><a href="<?=Url::to('/expence-types/index')?>">Харажатлар тури</a></li>
                        <? if (Yii::$app->controller->action->id!=="to-html-table") {?>
                        <li><a href="<?=Url::to('/file-info/to-html-table')?>">to Ms Excel</a></li>
                        <?}?>
                    </ul>
                </li>


                <li class="drop-down"><a>Маълумотлар</a>
                    <ul>
                        <li><a href="<?=Url::to('/bank/info')?>">Банклар ва филиаллар</a></li>
                        <li><a href="<?=Url::to('/company/info')?>">Корхоналар ва хисоб рақамлар</a></li>
                        <li><a href="<?=Url::to('/contracts/index')?>">Шартномалар</a></li>
<!--                        <li><a href="--><?//=Url::to('/currency/index')?><!--">to Ms Excel</a></li>-->
                    </ul>
                </li>

                <? if ((Yii::$app->user->can('admin')) && (Yii::$app->controller->action->id!=="to-html-table") && (Yii::$app->controller->action->id!=="table") ){?>
                    <li ><a href="">Админ</a></li>
                    <li ><a href="<?=Url::to('/user/index')?>">Фойдаланувчилар</a></li>
                <?}?>
                <? if (Yii::$app->user->isGuest) {?>

<!--                    <li > --><?//= Html::a('Рўйхатдан ўтиш', ['site/signup'], ['data' => ['method' => 'post']]) ?><!--</li>-->
                    <li > <?= Html::a('Кириш', ['site/login'], ['data' => ['method' => 'post']]) ?></li>
                <?}?>
                <? if (!Yii::$app->user->isGuest) {?>
                    <li > <?= Html::a('Чиқиш', ['/site/logout'], ['data' => ['method' => 'post']]) ?></li>

                <?}?>
                <?= (Yii::$app->controller->action->id=="to-html-table")?'<li class="active" onclick="exportTableToExcel(\'tblData\')"><a href="">Ms Excel юклаб олиш</a></li>':'' ?>
                <?= (Yii::$app->controller->action->id=="table")?'<li class="active" onclick="exportTableToExcel(\'tblData\', \'members-data\')"><a href="">Ms Excel юклаб олиш</a></li>':'' ?>



            </ul>
        </nav><!-- .nav-menu -->

    </div>
</header><!-- End Header -->

<script src="../../../themes/day/assets/vendor/jquery/jquery.min.js"></script>
<script src="../../../themes/day/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>