<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use dektrium\user\widgets\UserMenu;

/**
 * @var dektrium\user\models\User $user
 */

$user = Yii::$app->user->identity;
?>
<div class="card card-primary">
    <div class="card-header">
        <h4>
            <?= Html::img($user->profile->getAvatarUrl(24), [
                'class' => 'img-rounded',
                'alt' => $user->username,
            ]) ?>
            <?= $user->username ?>
        </h4>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a class="nav-link" href="<?= \yii\helpers\Url::to(['/user/settings/profile']) ?>">Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= \yii\helpers\Url::to(['/user/settings/account']) ?>">Akun</a>
            </li>
        </ul>
    </div>
</div>
