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
        <style>
            .navbar-bg{
                height: 70px;
            }
            .navbar-secondary{
                display: none !important;
            }
        </style>
    </head>
    <body class="layout-3">
        <?php $this->beginBody() ?>
        <div id="app">
            <div class="main-wrapper container">
                <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar">
                    <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="navbar-brand sidebar-gone-hide">
                        <img src="<?= \yii\helpers\Url::to('@web/img/logo-big.png') ?>" width="160" />
                    </a>
                    <div class="nav-collapse">
                        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                            <i class="fas fa-bars"></i>
                        </a>
                        <?= MenuHelper::getAssignedUserMenu(Yii::$app->user->id) ?>
                    </div>
                    <ul class="navbar-nav navbar-right ml-auto">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img alt="image" src="https://gravatar.com/avatar/<?= md5("arief7385@yahoo.com") ?>" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block"><?= isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : 'Guest' ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-title">Logged in <?= app\models\User::timeAgo(Yii::$app->user->identity->last_login_at) ?></div>
                                <a href="<?= \yii\helpers\Url::to(['/user/settings/account']) ?>" class="dropdown-item has-icon">
                                    <i class="far fa-user"></i> Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <?=
                                Html::a(
                                        '<i class="fas fa-sign-out-alt"></i> Logout', ['/user/logout'], ['data-method' => 'post', 'class' => 'dropdown-item has-icon text-danger']
                                )
                                ?>
                            </div>
                        </li>
                    </ul>
                </nav>
                <nav class="navbar navbar-secondary navbar-expand-lg" style="display: none !important">
                    <div class="container">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                                <ul class="dropdown-menu" style="display: none;">
                                    <li class="nav-item"><a href="index-0.html" class="nav-link">General Dashboard</a></li>
                                    <li class="nav-item"><a href="index.html" class="nav-link">Ecommerce Dashboard</a></li>
                                </ul>
                            </li>
                            <li class="nav-item active">
                                <a href="#" class="nav-link"><i class="far fa-heart"></i><span>Top Navigation</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="far fa-clone"></i><span>Multiple Dropdown</span></a>
                                <ul class="dropdown-menu" style="display: none;">
                                    <li class="nav-item"><a href="#" class="nav-link">Not Dropdown Link</a></li>
                                    <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Hover Me</a>
                                        <ul class="dropdown-menu" style="display: none;">
                                            <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                            <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Link 2</a>
                                                <ul class="dropdown-menu" style="display: none;">
                                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                                </ul>
                                            </li>
                                            <li class="nav-item"><a href="#" class="nav-link">Link 3</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <?php /* <div class="section-header">
                          <h1 class="mr-auto"><?= isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'][count($this->params['breadcrumbs']) - 1] : "Homepage" ?></h1>
                          <div class="stisla-breadcrumbs">
                          <?=
                          Breadcrumbs::widget([
                          'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                          ])
                          ?>
                          </div>
                          </div> */ ?>
                        <div class="section-body">
                            <?= $content ?>
                        </div>
                    </section>
                </div>
                <footer class="main-footer">
                    <div class="footer-left">
                        Copyright &copy; <?= date('Y') ?>
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