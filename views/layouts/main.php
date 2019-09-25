<?php

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
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <section id="top-nav" class="bg-black">
            <div class="container flex items-center">
                <div class="flex flex-grow pull-left text-white">
                    <div class="">
                        Klienditeenindus
                        <span class="text-bold margin-left-small"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> 1715</span>
                        <span class="text-bold margin-left-small"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> E-P 9.00-21.00</span>
                    </div>
                </div>
                <div class="pull-right text-white">
                    <div class="padding-top-small padding-bottom-small">
                        Tere, Kaupo Kasutaja
                        <button class="btn btn-sm btn-warning button button-warning margin-left-small text-bold"><span class="glyphicon glyphicon-log-out margin-right-small"></span> LOG OUT</button>
                    </div>
                </div>
            </div>
        </section>
        <section id="nav">
            <div class="container padding-top-medium">
                <div class="row">
                    <div class="col-sm-3">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <?= Html::img('@web/images/logo.png', ['class' => 'img img-responsive']) ?>
                    </div>
                    <div class="col-sm-8">
                        <div id="navbar" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav w-full">
                                <li><a href="#">Add <span class="glyphicon glyphicon-chevron-right "></span></li>
                                <li><a href="#">Here <span class="glyphicon glyphicon-chevron-right "></span></a></li>
                                <li><a href="#">Random <span class="glyphicon glyphicon-chevron-right "></span></a></li>
                                <li><a href="#">Links to our page <span class="glyphicon glyphicon-chevron-right "></span></a></li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-sm-1 hidden-sm hidden-xs">
                        <span class="text-small">По-русски</span>
                    </div>
                </div>
            </div>
        </section>
        <section id="menu">
            <div class="bg-gray">
                <div class="container">
                    <ul class="list-inline">
                        <li><a href="#">Loans</a></li>
                        <li><a href="<?=Yii::$app->url->toRoute('/user')?>">Users</a></li>
                    </ul>
                </div>
            </div>
        </section>
        <section id="content">
            <div class="container">
                <div class="card position-relative">
                    <div class=" position-top-left">
                        <a href="#">
                            <?= Html::img('@web/images/back.png', ['class' => 'img img-responsive']) ?>
                        </a>
                    </div>
                    <div class="padding-large">
                        <p class="text-lead"><?= $this->title ?></p>
                    </div>
                    <div class="padding-left-large font-400 padding-right-large">
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="footer">
        <!--  footer  -->
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>