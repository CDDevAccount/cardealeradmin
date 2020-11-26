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
     <meta name="robots" content="noindex, nofollow">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
      //  'brandLabel' => Yii::$app->name,
        'brandLabel' => '<img src="/cardealer-logosm.png" class="pull-left"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Leads Stats', 'url' => ['/stats/index']],
            ['label' => 'Model Stats', 'url' => ['/stats/stats']],
            ['label' => 'FB Month','url'=>['/stats/facebook/']],
            ['label' => 'Lead Maps', 'items' => [
                ['label' => 'Dealer Signed Map', 'url' => ['/dealer/facebooked']],
                ['label' => 'Dealer Signed up 7 Days', 'url' => ['/stats/map?days=7&new=2']],
                ['label' => 'Lead Map', 'url' => ['/stats/map']],
                ['label' => 'Leads Last 24 Hours', 'url' => ['/stats/map?days=1&new=0']],
                ['label' => 'Leads Last 7 Days', 'url' => ['/stats/map?days=7&new=0']],
                

            ]],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>
                    <li style="list-style: none; display: inline;float:right">

                            <form class="navbar-form" role="search" action="/find/our/">
                                <div class="input-group">
                                    <input class="form-control" placeholder="Search" name="SearchTerm" id="SearchTerm" type="text">

                                    <div class="input-group-btn"></div>
                                </div>
                            </form>

                    </li>
                '
            )
        ],
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
        <p class="pull-left">&copy; Car Dealer Media <?= date('Y') ?></p>

        <p class="pull-right"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
