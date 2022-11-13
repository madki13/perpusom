<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use kartik\nav\NavX;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use app\widgets\Alert;
use app\assets\BS4Asset;

BS4Asset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <a href="<?= Url::to(['/user/login']) ?>">
                                <img src="<?=Url::to(['/img/logo-pemda.png']) ?>" alt="logo" width="100" class="shadow-light rounded-circle">
                            </a>
                            <p class="text-center">Sistem Perpustakaan<br />SMKN 2 Jakarta</p>
                        </div>
                        
                        <?=$content?>
                        
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>