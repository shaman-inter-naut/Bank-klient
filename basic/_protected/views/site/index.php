<?
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
?>




<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-none d-lg-flex align-items-center fixed-top ">
    <div class="container d-flex">
        <div class="contact-info mr-auto">
            <i class="icofont-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a>
            <i class="icofont-phone"></i><a href="tel:+1 5589 55488 55">+1 5589 55488 55</a>
        </div>
<!--        <div class="social-links">-->
        <div >
            <? if (Yii::$app->user->isGuest) {?>
                <?= Html::a('Рўйхатдан ўтиш', ['site/signup'], [
                    'class' => 'btn-success btn-xs',
                    'data' => [
                        'method' => 'post']])?>
<!--                --><?//= Html::a('Рўйхатдан ўтиш', ['site/signup'], ['data' => ['method' => 'post'],['class'=>'btn-success']]) ?>
<!--                --><?//= Html::a('Кириш', ['site/login'], ['data' => ['method' => 'post'],['class'=>'buy-tickets']]) ?>
                <?= Html::a('Кириш', ['site/login'], [
                    'class' => 'btn-success btn-xs',
                    'data' => [
                        'method' => 'post']])?>

            <?}?>
            <? if (!Yii::$app->user->isGuest) {?>
                <?= Html::a('Чиқиш', ['/site/logout'], [
                    'class' => 'btn-danger btn-xs',
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


<!-- ======= Hero Section ======= -->
<section id="hero" style="height: 300px" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">

        <h1>SHAVKAT MIRZIYOYEV:</h1>
        <h2>TAYYOR MAHSULOTLAR ISHLAB CHIQARISHNI KO‘PAYTIRISH – DAVR TALABI</h2>
        <a href="<?=Url::to('/file-info/to-excel')?>" class="btn-get-started scrollto">to Ms Excel</a>
    </div>
</section><!-- End Hero -->

<main id="main">


    <!-- ======= Why Us Section ======= -->
    <section id="why-us" style="padding-top: 50px" class="why-us">
        <div class="container">

            <div class="row">

                <div class="col-lg-4" data-aos="fade-up">
                    <div style="background-image: url('themes/day/assets/img/bank.jpg'); background-size: cover; "  class="box">
                        <a style="text-decoration: none" href="<?=Url::to('/bank/index')?>">
                        <span style="color: white" >Банклар</span>
                        <h4 style="color: white">Lorem Ipsum</h4>
                        <p style="color: white">Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p></a>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up">
                    <div style="background-image: url('themes/day/assets/img/company.jpg'); background-size: cover; "  class="box">
                        <a style="text-decoration: none" href="<?=Url::to('/company/index')?>">
                        <span style="color: white" >Корхоналар</span>
                        <h4 style="color: white">Lorem Ipsum</h4>
                        <p style="color: white">Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p></a>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up">
                    <div style="background-image: url('themes/day/assets/img/valyuta.jpg'); background-size: cover; "  class="box">
                        <a style="text-decoration: none" href="<?=Url::to('/currency/index')?>">
                        <span style="color: white" >Валюталар</span>
                        <h4 style="color: white">Lorem Ipsum</h4>
                        <p style="color: white">Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p></a>
                    </div>
                </div>





            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Services Section ======= -->
    <section style="padding-top: 0" id="services" class="services">
        <div class="container">

            <div class="section-title">
                <span>Services</span>
                <h2>Services</h2>
                <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bxl-dribbble"></i></div>
                        <h4><a href="<?=Url::to('/bank/info')?>">Банклар ва филиаллар</a></h4>
                        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="150">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-file"></i></div>
                        <h4><a href="<?=Url::to('/company/info')?>">Корхоналар ва хисоб рақамлар</a></h4>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-tachometer"></i></div>
                        <h4><a href="<?=Url::to('/contracts/index')?>">Шартномалар</a></h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="450">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-world"></i></div>
                        <h4><a href="<?=Url::to('/file-info/index')?>">Файллар</a></h4>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-slideshow"></i></div>
                        <h4><a href="<?=Url::to('/xujjat/index')?>">Умумий файллар</a></h4>
                        <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="750">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-arch"></i></div>
                        <h4><a href="<?=Url::to('/expence-types/index')?>">expence_types</a></h4>
                        <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">

            <div class="text-center">
                <h3>Call To Action</h3>
                <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <a class="cta-btn" href="#">Call To Action</a>
            </div>

        </div>
    </section><!-- End Cta Section -->


    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left">
                    <img src="themes/day/assets/img/about.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right">
                    <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                    <p class="font-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua.
                    </p>
                    <ul>
                        <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                        <li><i class="icofont-check-circled"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                        <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                    </ul>
                    <p>
                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                        culpa qui officia deserunt mollit anim id est laborum
                    </p>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->






    <!-- ======= Pricing Section ======= -->
<!--    <section id="pricing" class="pricing">-->
<!--        <div class="container">-->
<!---->
<!--            <div class="section-title">-->
<!--                <span>Pricing</span>-->
<!--                <h2>Pricing</h2>-->
<!--                <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>-->
<!--            </div>-->
<!---->
<!--            <div class="row">-->
<!---->
<!--                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="150">-->
<!--                    <div class="box">-->
<!--                        <h3>Free</h3>-->
<!--                        <h4><sup>$</sup>0<span> / month</span></h4>-->
<!--                        <ul>-->
<!--                            <li>Aida dere</li>-->
<!--                            <li>Nec feugiat nisl</li>-->
<!--                            <li>Nulla at volutpat dola</li>-->
<!--                            <li class="na">Pharetra massa</li>-->
<!--                            <li class="na">Massa ultricies mi</li>-->
<!--                        </ul>-->
<!--                        <div class="btn-wrap">-->
<!--                            <a href="#" class="btn-buy">Buy Now</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-lg-4 col-md-6 mt-4 mt-md-0" data-aos="zoom-in">-->
<!--                    <div class="box featured">-->
<!--                        <h3>Business</h3>-->
<!--                        <h4><sup>$</sup>19<span> / month</span></h4>-->
<!--                        <ul>-->
<!--                            <li>Aida dere</li>-->
<!--                            <li>Nec feugiat nisl</li>-->
<!--                            <li>Nulla at volutpat dola</li>-->
<!--                            <li>Pharetra massa</li>-->
<!--                            <li class="na">Massa ultricies mi</li>-->
<!--                        </ul>-->
<!--                        <div class="btn-wrap">-->
<!--                            <a href="#" class="btn-buy">Buy Now</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-lg-4 col-md-6 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="150">-->
<!--                    <div class="box">-->
<!--                        <h3>Developer</h3>-->
<!--                        <h4><sup>$</sup>29<span> / month</span></h4>-->
<!--                        <ul>-->
<!--                            <li>Aida dere</li>-->
<!--                            <li>Nec feugiat nisl</li>-->
<!--                            <li>Nulla at volutpat dola</li>-->
<!--                            <li>Pharetra massa</li>-->
<!--                            <li>Massa ultricies mi</li>-->
<!--                        </ul>-->
<!--                        <div class="btn-wrap">-->
<!--                            <a href="#" class="btn-buy">Buy Now</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--    </section>-->
    <!-- End Pricing Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
        <div class="container">

            <div class="section-title">
                <span>Team</span>
                <h2>Team</h2>
                <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                    <div class="member">
                        <img src="themes/day/assets/img/team/team-1.jpg" alt="">
                        <h4>Walter White</h4>
                        <span>Chief Executive Officer</span>
                        <p>
                            Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut
                        </p>
                        <div class="social">
                            <a href=""><i class="icofont-twitter"></i></a>
                            <a href=""><i class="icofont-facebook"></i></a>
                            <a href=""><i class="icofont-instagram"></i></a>
                            <a href=""><i class="icofont-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                    <div class="member">
                        <img src="themes/day/assets/img/team/team-2.jpg" alt="">
                        <h4>Sarah Jhinson</h4>
                        <span>Product Manager</span>
                        <p>
                            Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum temporibus
                        </p>
                        <div class="social">
                            <a href=""><i class="icofont-twitter"></i></a>
                            <a href=""><i class="icofont-facebook"></i></a>
                            <a href=""><i class="icofont-instagram"></i></a>
                            <a href=""><i class="icofont-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                    <div class="member">
                        <img src="themes/day/assets/img/team/team-3.jpg" alt="">
                        <h4>William Anderson</h4>
                        <span>CTO</span>
                        <p>
                            Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara
                        </p>
                        <div class="social">
                            <a href=""><i class="icofont-twitter"></i></a>
                            <a href=""><i class="icofont-facebook"></i></a>
                            <a href=""><i class="icofont-instagram"></i></a>
                            <a href=""><i class="icofont-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Team Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <span>Биз билан алоқа</span>
                <h2>Биз билан алоқа</h2>
                <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>
            </div>



            <div class="row" data-aos="fade-up">

                <div class="col-lg-6 ">
                    <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                </div>

                <div class="col-lg-6">
                    <div class="row" data-aos="fade-up">
                        <div class="col-lg-6">
                            <div class="info-box mb-4">
                                <i class="bx bx-map"></i>
                                <h3>Манзил</h3>
                                <p>Андижон, Каттайўл , 128-уй</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box mb-4">
                                <i class="bx bx-envelope"></i>
                                <h3>Email </h3>
                                <p>admin@avtocompanent.uz</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box mb-4">
                                <a style="text-decoration: none" href="tel:+1 5589 55488 55">
                                <i class="bx bx-phone-call"></i>
                                <h3>Қўнғироқ қилинг</h3>
                                <p>+1 5589 55488 55</p></a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box mb-4">
                                <a style="text-decoration: none" href="https://t.me/Avtokompanent">
                                <i class="bx bxl-telegram"></i>
                                <h3>Telegram</h3>
                                <p> @Avtokompanent</p></a>
                            </div>
                        </div>
<!---->
<!--                        <div class="col-lg-3 col-md-6">-->
<!--                            <div class="info-box  mb-4">-->
<!--                                <i class="bx bx-envelope"></i>-->
<!--                                <h3>Email Us</h3>-->
<!--                                <p>contact@example.com</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="col-lg-3 col-md-6">-->
<!--                            <div class="info-box  mb-4">-->
<!--                                <i class="bx bx-phone-call"></i>-->
<!--                                <h3>Call Us</h3>-->
<!--                                <p>+1 5589 55488 55</p>-->
<!--                            </div>-->
<!--                        </div>-->

                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>GM</span></strong>.UzAuto
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


<div class="modal fade" id="login-modal" data-open-onload="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div style="padding: unset !important;" class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div style="background-color: white !important; padding: unset;" class="col-lg-6 bg-primary nop">

                            <div style="padding: 20px; background-color: " class="p-40">
                                <h2 >'kirolmaydi'</h2>

                            </div>
                        </div>
                        <div style="padding: 20px" class="col-lg-6 p-40 bg-white">

                            <form id="login-form" action="/site/login" method="post">
                                <?=Html::hiddenInput(Yii::$app->getRequest()->csrfParam, Yii::$app->getRequest()->getCsrfToken(), []);?>
                                <div class="form-group">
                                    <label>'Login'</label>
                                    <input id="login-id" type="text" class="form-control"name="LoginForm[username]">
                                </div>
                                <div class="form-group">
                                    <label>Parol</label>
                                    <input id="login-pass" type="password" class="form-control" name="LoginForm[password]">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary" style="background-color: red; border-color: red"><('kirish'</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!---->
<?//
//Modal::begin([
//        'header' => '<h3>Кириш</h3>',
//    'id' => 'modal',
//]);
//?>
<!--    <div id="modalContent">-->
<!---->
<!--    </div>-->
<?php
//Modal::end();
//?>