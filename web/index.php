<?php

if(strpos($_SERVER['REQUEST_URI'], 'guest/s/default')) {
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?" . $_SERVER['QUERY_STRING']);
    EXIT;
}

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
