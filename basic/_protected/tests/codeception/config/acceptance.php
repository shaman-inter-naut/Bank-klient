<?php
/**
 * Application configuration for acceptance tests
 */
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../../config/web3.php'),
    require(__DIR__ . '/config.php'),
    [

    ]
);
