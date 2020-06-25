<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Nenad Zivkovic <nenad@freetuts.org>
 * 
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
//        '../../web/assets/css/style.css',
        '../../web/assets/vendor/aos/aos.css',
        '../../web/assets/vendor/owl.carousel/assets/owl.carousel.min.css',
        '../../web/assets/vendor/venobox/venobox.css',
        '../../web/assets/vendor/boxicons/css/boxicons.min.css',
        '../../web/assets/vendor/icofont/icofont.min.css',
        '../../web/assets/vendor/bootstrap/css/bootstrap.min.css',
        '../../web/new.css',
        'css/bootstrap.min.css',
        'css/style.css',











    ];

    public $js = [


//        '../../web/assets/vendor/jquery/jquery.min.js',
//        '../../web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
        '../../web/assets/vendor/jquery.easing/jquery.easing.min.js',
        '../../web/assets/vendor/php-email-form/validate.js',
        '../../web/assets/vendor/isotope-layout/isotope.pkgd.min.js',
        '../../web/assets/vendor/venobox/venobox.min.js',
        '../../web/assets/vendor/owl.carousel/owl.carousel.min.js',
        '../../web/assets/vendor/aos/aos.js',
        '../../web/assets/js/main.js',
        '../../web/sardor.js',

    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
