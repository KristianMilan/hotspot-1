<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="/css/fontawesome.css" rel="stylesheet">
    <style>
        body {
            background-color:#ddd0;
            background-image: url("/images/logo1.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            color:#fff;
        }

        .btn-info {
            color: #fff;
            background-color: #77D427;
            border-color: #77D427;
        }
        .btn-info:hover {
            color: #fff;
            background-color: #67B622;
            border-color: #67B622;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<!--<div style="position: absolute; z-index: -10; background-color: #000; width: 100%; height: 100%; opacity: 0.4"></div>-->
<div class="wrap" style="z-index: 999">
    <div class="container center-block">
        <div class="" style="padding-top:35px;padding-bottom: 20px;text-align: center; font-size: 24px" id="header">
            Добро пожаловать в зону бесплатного Wi-Fi

            <hr width="25%"/>
        </div>
        <?= $content ?>

    </div>
</div>
<br><br>
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
