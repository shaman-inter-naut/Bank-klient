<?
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
?>

<link href="web/tg_call.css" rel="stylesheet">

<!-- ======= Top Bar ======= -->
<div style="background-color: #4a4b8e; height: 8%" id="topbar" class="d-none d-lg-flex align-items-center fixed-top ">

    <div class="cen container d-flex">
        <div class="contact-info mr-auto">
<!--            <img style="height: 20px" src="themes/logo.jpg">-->
<!--            themes/day/assets/img/team/team-3.jpg-->
<!--            <i class="icofont-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a>-->
<!--            <a style="color:#4d90fe;   font-size: 20px; border: 1px solid #4d90fe;" >UzAutoComponents</a> <br> <i style="color: orange; ">CASH FLOW INFO</i>-->
            <a style="color:#4d90fe;   font-size: 20px; border: 1px solid #4d90fe;" >UzAutoComponents</a> <br> <i style="color: orange; ">CASH FLOW INFO</i>
<!--            <i style="padding-left: 80px" class="cen icofont-phone"></i><a href="tel:+1 5589 55488 55">+1 5589 55488 55</a>-->
        </div>
<!--        <div class="social-links">-->
        <div >




<!--            <div id="tooltip" style="text-decoration: none;">-->



                <a style="text-decoration: none; " href="<?=Url::to('/file-info/to-html-table')?>">

                    <span id="tooltip" style="color:#52af50; text-decoration: none  font-size: 20px;" >Кўчириб олиш</span> </i>
                    <img style="height: 30px; padding-right: 50px" src="themes/Excel-icon.png">
                </a>
<!--                <span class="tooltiptext">Юклаб олинган Ms Excel форматдаги файллар ушбу манзилга сақланди: <br><br><b>С:/Сводные отчёты/Сводный отчёт (...)</b></span>-->
<!--            </div>-->

            <? if (Yii::$app->user->isGuest) {?>
<!--                --><?//= Html::a('Рўйхатдан ўтиш', ['site/signup'], [
//                    'class' => 'btn-success btn-xs',
//                    'data' => [
//                        'method' => 'post']])?>
<!--                --><?//= Html::a('Рўйхатдан ўтиш', ['site/signup'], ['data' => ['method' => 'post'],['class'=>'btn-success']]) ?>
<!--                --><?//= Html::a('Кириш', ['site/login'], ['data' => ['method' => 'post'],['class'=>'buy-tickets']]) ?>
                <?= Html::a('Кириш', ['site/login'], [
                    'class' => 'btn-success btn',
                    'data' => [
                        'method' => 'post']])?>

            <?}?>
            <? if (!Yii::$app->user->isGuest) {?>
                <? if(Yii::$app->user->can('admin')) {?>
                <a href="<?=Url::to('/user/index')?>" class="btn-success btn " >Фойдаланувчилар</a>
                <?}?>
                <?= Html::a('Чиқиш', ['/site/logout'], [
                    'class' => 'btn-danger btn',
                    'data' => [
                        'method' => 'post']])?>
<!--                --><?//= Html::a('Чиқиш', ['/site/logout'], ['data' => ['method' => 'post'],['class'=>'btn btn-danger btn-xs']]) ?>


            <?}?>
<!--            <a href="#" class="twitter btn btn-success btn-xs">Кириш</a>-->
<!--            <a href="#" class="twitter btn btn-danger btn-xs">Чиқиш</a>-->
<!--            <a href="#" class="twitter btn btn-info btn-xs">Рўйхатдан ўтиш</a>-->

        </div>
    </div>
</div>


<!---->
<!--<section id="hero" style="height: 350px" class="d-flex align-items-center">-->
<!--    <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">-->
<!--        <div class="col-md-6">-->
<!--            <h2>SHAVKAT MIRZIYOYEV:</h2>-->
<!--            <h2>TAYYOR MAHSULOTLAR ISHLAB CHIQARISHNI KO‘PAYTIRISH – DAVR TALABI</h2>-->
<!--            <a href="--><?//=Url::to('/file-info/to-excel')?><!--" class="btn-get-started scrollto">to Ms Excel</a>-->
<!--        </div>-->
<!--        <div class="col-md-6">-->
<!---->
<!--        </div>-->
<!---->
<!--    </div>-->
<!--</section>-->

<main id="main">

    <!-- ======= Services Section ======= -->
    <section style="padding-top: 60px" id="services" class="services">
        <div class="container">

            <div class="section-title">
                <span>Банк-клиент тизими</span>
                <h2>Банк-клиент тизими</h2>
<!--                <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>-->
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bxl-dribbble"></i></div>
                        <h4><a href="<?=Url::to('/bank/info')?>">Банклар ва филиаллар</a></h4>
                        <p>Банкларга тегишли бўлган филиалларни бошқариш сахифаси</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="150">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-file"></i></div>
                        <h4><a href="<?=Url::to('/company/info')?>">Корхоналар ва хисоб рақамлар</a></h4>
                        <p>Корхоналарнинг хисоб рақамларини бошқариш сахифаси</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-tachometer"></i></div>
                        <h4><a href="<?=Url::to('/contracts/index')?>">Шартномалар</a></h4>
                        <p>Корхоналар ўртасидаги шартномаларни бошқариш сахифаси</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="450">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-world"></i></div>
                        <h4><a href="<?=Url::to('/file-info/index')?>">Файллар</a></h4>
                        <p>Файлларни тизимга юклаш ва бошқариш сахифаси</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-slideshow"></i></div>
                        <h4><a href="<?=Url::to('/xujjat/table')?>">Барча проводкалар</a></h4>
                        <p>Барча корхоналарнинг барча ҳисоб рақамларидаги кирим чиқим амалиётлари</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="750">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-arch"></i></div>
                        <h4><a href="<?=Url::to('/expence-types/index')?>">Харажатлар тури</a></h4>
                        <p>Барча турдаги шартномвлвр харажатлари тури</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Services Section -->


    <!-- ======= Why Us Section ======= -->
    <section id="why-us" style="padding-top: 50px" class="why-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-4" data-aos="fade-up">
                    <div   class="box">
                        <a style="text-decoration: none" href="<?=Url::to('/bank/index')?>">
                            <span  >Банклар</span>
                            <h5 style="color: black" >Банкларни бошқариш</h5>
<!--                            <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p>-->
                        </a>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up">
                    <div   class="box">
                        <a style="text-decoration: none" href="<?=Url::to('/company/index')?>">
                            <span  >Корхоналар</span>
                            <h5 style="color: black" >Корхоналарни бошқариш</h5>
<!--                            <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p>-->
                        </a>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up">
                    <div   class="box">
                        <a style="text-decoration: none" href="<?=Url::to('/currency/index')?>">
                            <span  >Валюталар</span>
                            <h5 style="color: black" >Валюталар бошқариш</h5>
<!--                            <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p>-->
                        </a>
                    </div>
                </div>
                <!---->
                <!--                <div class="col-lg-4" data-aos="fade-up">-->
                <!--                    <div style="background-image: url('themes/day/assets/img/bank.jpg'); background-size: cover; "  class="box">-->
                <!--                        <a style="text-decoration: none" href="--><?//=Url::to('/bank/index')?><!--">-->
                <!--                        <span style="color: white" >Банклар</span>-->
                <!--                        <h4 style="color: white">Lorem Ipsum</h4>-->
                <!--                        <p style="color: white">Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p></a>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!---->
                <!--                <div class="col-lg-4" data-aos="fade-up">-->
                <!--                    <div style="background-image: url('themes/day/assets/img/company.jpg'); background-size: cover; "  class="box">-->
                <!--                        <a style="text-decoration: none" href="--><?//=Url::to('/company/index')?><!--">-->
                <!--                        <span style="color: white" >Корхоналар</span>-->
                <!--                        <h4 style="color: white">Lorem Ipsum</h4>-->
                <!--                        <p style="color: white">Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p></a>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!---->
                <!--                <div class="col-lg-4" data-aos="fade-up">-->
                <!--                    <div style="background-image: url('themes/day/assets/img/valyuta.jpg'); background-size: cover; "  class="box">-->
                <!--                        <a style="text-decoration: none" href="--><?//=Url::to('/currency/index')?><!--">-->
                <!--                        <span style="color: white" >Валюталар</span>-->
                <!--                        <h4 style="color: white">Lorem Ipsum</h4>-->
                <!--                        <p style="color: white">Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p></a>-->
                <!--                    </div>-->
                <!--                </div>-->





            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Cta Section ======= -->
<!--    <section id="cta" class="cta">-->
<!--        <div class="container" data-aos="zoom-in">-->

<!--            <div class="text-center">-->
<!--                <h3>to Ms Excel</h3>-->
<!--                <p>Хужжатларни ушбу ҳавола орқали кўчириб олинг</p>-->
<!--                <a class="cta-btn" href="#">Call To Action</a>-->
<!--                <a href="--><?//=Url::to('/file-info/to-excel')?><!--">-->
<!--                    <img style="height: 50px" src="themes/Excel-icon.png">-->
<!--                </a>-->
<!--            </div>-->

<!--        </div>-->
<!--    </section>-->
    <!-- End Cta Section -->



<!--    <section id="contact" class="contact">-->
<!--        <div class="container">-->
<!---->
<!--            <div class="section-title">-->
<!--                <span>Биз билан алоқа</span>-->
<!--                <h2>Биз билан алоқа</h2>-->
<!--                <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>-->
<!--            </div>-->
<!---->
<!---->
<!---->
<!--            <div class="row" data-aos="fade-up">-->
<!---->
<!--                <div class="col-lg-6 ">-->
<!--                    <iframe class="mb-4 mb-lg-0"-->
<!--                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5415.278233154889!2d72.3458107!3d40.7514471!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQ1JzE3LjkiTiA3MsKwMjAnNDcuNSJF!5e1!3m2!1sru!2s!4v1593400268382!5m2!1sru!2s"-->
<!--                            frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>-->
<!--                </div>-->
<!---->
<!--                <div class="col-lg-6">-->
<!--                    <div class="row" data-aos="fade-up">-->
<!--                        <div class="col-lg-6">-->
<!--                            <div class="info-box mb-4">-->
<!--                                <i class="bx bx-map"></i>-->
<!--                                <h3>Манзил</h3>-->
<!--                                <p>Андижон, Каттайўл , 128-уй</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-lg-6">-->
<!--                            <div class="info-box mb-4">-->
<!--                                <i class="bx bx-envelope"></i>-->
<!--                                <h3>Email </h3>-->
<!--                                <p>admin@avtocompanent.uz</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-lg-6">-->
<!--                            <div class="info-box mb-4">-->
<!--                                <a style="text-decoration: none" href="tel:+1 5589 55488 55">-->
<!--                                <i class="bx bx-phone-call"></i>-->
<!--                                <h3>Қўнғироқ қилинг</h3>-->
<!--                                <p>+1 5589 55488 55</p></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-lg-6">-->
<!--                            <div class="info-box mb-4">-->
<!--                                <a style="text-decoration: none" href="https://t.me/Avtokompanent">-->
<!--                                <i class="bx bxl-telegram"></i>-->
<!--                                <h3>Telegram</h3>-->
<!--                                <p> @Avtokompanent</p></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--    </section>-->
    <!-- End Contact Section -->

</main><!-- End #main -->
<div class="btns" id="btns">
    <a href="tel:+ 998 93 983 85 00" target="_blank" class="wh"><img alt="Napa Phone" src="/themes/phone.svg" width="60"/></a>
    <a href="https://t.me/USFabduqaxxorov" class="tg" ><img alt="Napa Telegram" src="/themes/telegram.svg" width="60"/></a>
</div>


<footer id="footer">
    <div style="padding: 20px 0 20px 0">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5415.278233154889!2d72.3458107!3d40.7514471!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQ1JzE3LjkiTiA3MsKwMjAnNDcuNSJF!5e1!3m2!1sru!2s!4v1593400268382!5m2!1sru!2s"
                            frameborder="0" style="border:0; width: 100%; height: 100%;" allowfullscreen></iframe>
                </div>
                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <div>
                        <h4>Манзил</h4>
                        <p><i  class="icon bx bx-map"></i>Андижон шахар, Янги айланма кўчаси, 1-уй</p>
                    </div>
                    <div>
                        <h4>Email</h4>
                        <p> <i  class="icon bx bx-envelope"></i>info@uzautocomponents.uz</p>
                    </div>

                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <div>
                        <h4>Telegram</h4>
                        <a style="text-decoration: none" href="https://t.me/Avtokompanent">
                        <p><i  class="icon bx bxl-telegram"></i>@Avtokompanent</p>

                        </a>
                    </div>
                    <div>

                        <h4>Қўнғироқ қилинг</h4>
                        <a style="text-decoration: none" href="tel:+ 998 93 983 85 00">
                            <p> <i class="icon bx bx-phone-call"></i>+ 998 93 983 85 00</p>
                        </a>
                    </div>

                </div>


            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy;  UzAutoComponents<br> <?=date('d.m.yy')?>
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/day-multipurpose-html-template-for-free/ -->
<!--            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
        </div>
    </div>
</footer><!-- End Footer -->


<!-- ======= Footer ======= -->
<!--<footer id="footer">-->
<!--    <div class="container">-->
<!--        <div class="copyright">-->
<!--            &copy; Copyright <strong><span>GM</span></strong>.UzAuto-->
<!--        </div>-->
<!--        <div class="credits">        -->
<!--        </div>-->
<!--    </div>-->
<!--</footer>-->
<!-- End Footer -->

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="themes/day/assets/vendor/jquery/jquery.min.js"></script>
<script src="themes/day/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--<script src="themes/day/assets/vendor/jquery.easing/jquery.easing.min.js"></script>-->
<!--<script src="themes/day/assets/vendor/php-email-form/validate.js"></script>-->
<!--<script src="themes/day/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>-->
<!--<script src="themes/day/assets/vendor/venobox/venobox.min.js"></script>-->
<!--<script src="themes/day/assets/vendor/owl.carousel/owl.carousel.min.js"></script>-->
<!--<script src="themes/day/assets/vendor/aos/aos.js"></script>-->

<!-- Template Main JS File -->
<!--<script src="themes/day/assets/js/main.js"></script>-->

