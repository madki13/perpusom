<?php

use app\assets\BS4Asset;
use app\components\MenuHelper;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */

BS4Asset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div id="app">
            <div class="main-wrapper">
                <div class="navbar-bg d-print-none"></div>
                <nav class="navbar navbar-expand-lg main-navbar d-print-none">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="mr-auto">&nbsp;</div>
                    <ul class="navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img alt="image" src="https://gravatar.com/avatar/<?= md5("arief7385@yahoo.com") ?>" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block"><?= isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : 'Guest' ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!--<div class="dropdown-title">Logged in 5 min ago</div>-->
                                <a href="<?= \yii\helpers\Url::to(['/user/settings/account']) ?>" class="dropdown-item has-icon">
                                    <i class="far fa-user"></i> Profil
                                </a>
<!--                                <a href="features-activities.html" class="dropdown-item has-icon">
                                    <i class="fas fa-bolt"></i> Activities
                                </a>
                                <a href="features-settings.html" class="dropdown-item has-icon">
                                    <i class="fas fa-cog"></i> Settings
                                </a>-->
                                <div class="dropdown-divider"></div>
                                <?= Html::a(
                                    '<i class="fas fa-sign-out-alt"></i> Keluar',
                                    ['/user/logout'],
                                    ['data-method' => 'post', 'class' => 'dropdown-item has-icon text-danger']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="main-sidebar sidebar-style-2 d-print-none">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">
                                <img src="<?= \yii\helpers\Url::to('@web/img/logo-big-jakpus.png') ?>" width="160" />
                            </a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">
                                <img src="<?= \yii\helpers\Url::to('@web/img/logo-small.png') ?>" width="60" />
                            </a>
                        </div>
                        <?php /*
                        <aside id="sidebar-wrapper">
                        <?= Menu::widget([
//                            'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id),
                            'linkTemplate' => '<a href="{url}" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>{label}</span></a>',
                            'items' => [
                                ['label' => 'Home', 'url' => '#' , 'options' => ['class' => 'nav-item dropdown'],
                                    'submenuTemplate' => '<ul class="dropdown-menu">{items}</ul>',
//                                    'linkTemplate' => '<a href="{url}" class="nav-link">{label}</a>',
                                    'labelTemplate' => '<i class="fas fa-fire"></i><span>{label}</span>',
                                    'items' => [
                                        ['label' => 'About', 'url' => ['/site/about']],
                                    ]
                                ],
                            ],
                            'options' => ['class' => 'sidebar-menu'],
                        ]);
                    </aside>*/ ?>
                        <?= MenuHelper::getAssignedMenu(Yii::$app->user->id) ?>

<!--                        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                                <i class="fas fa-rocket"></i> Documentation
                            </a>
                        </div>-->
                    </aside>
                </div>

                <!-- Main Content -->
                <div class="main-content d-print-inline">
                    <section class="section">
                        <div class="section-header d-print-none">
                            <h1 class="mr-auto"><?= isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'][count($this->params['breadcrumbs'])-1] : "Homepage" ?></h1>
                            <div class="stisla-breadcrumbs">
                                <?= Breadcrumbs::widget([
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]) ?>
                            </div>
                        </div>
                        <div class="section-body">
                            <?= $content ?>
                        </div>
                    </section>
                </div>
                <footer class="main-footer d-print-none">
                    <div class="footer-left">
                        Copyright &copy; <?= date('Y') ?> P2KPTK2 JAKARTA PUSAT
                    </div>
                    <div class="footer-right">
                        2.3.0
                    </div>
                </footer>
            </div>
        </div>
<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>