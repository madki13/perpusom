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
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\RecoveryForm $model
 */

$this->title = Yii::t('user', 'Reset your password');
$this->params['breadcrumbs'][] = $this->title;
$this->context->layout = "@app/themes/stisla/layouts/main-login";
?>
<div class="card card-primary">
    <div class="card-header">
        <h4><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'id' => 'password-recovery-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
        ]); ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= Html::submitButton(Yii::t('user', 'Finish'), ['class' => 'btn btn-success btn-block']) ?><br>

        <?php ActiveForm::end(); ?>
    </div>
</div>
