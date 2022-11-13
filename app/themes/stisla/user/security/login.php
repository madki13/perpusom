<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use dektrium\user\models\LoginForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
$this->context->layout = "@app/themes/stisla/layouts/main-login";
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="card card-primary">
    <div class="card-header"><h4><?= Html::encode($this->title) ?></h4></div>
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'validateOnBlur' => false,
            'validateOnType' => false,
            'validateOnChange' => false,
        ]) ?>
            <?php if ($module->debug): ?>
                <?= $form->field($model, 'login', [
                    'inputOptions' => [
                        'autofocus' => 'autofocus',
                        'class' => 'form-control',
                        'tabindex' => '1']])->dropDownList(LoginForm::loginList());
                ?>

            <?php else: ?>

                <?= $form->field($model, 'login',
                    ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]
                );
                ?>

            <?php endif ?>

            <?php if ($module->debug): ?>
                <div class="alert alert-warning">
                    <?= Yii::t('user', 'Password is not necessary because the module is in DEBUG mode.'); ?>
                </div>
            <?php else: ?>
                <?= $form->field(
                    $model,
                    'password',
                    ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])
                    ->passwordInput()
                    ->label(
                        Yii::t('user', 'Password')
                        . ($module->enablePasswordRecovery ?
                            ' (' . Html::a(
                                Yii::t('user', 'Forgot password?'),
                                ['/user/recovery/request'],
                                ['tabindex' => '5']
                            )
                            . ')' : '')
                    ) ?>
            <?php endif ?>

            <?= $form->field($model, 'rememberMe', [
                'template' => '<div class="custom-control custom-checkbox">{input}<label class="custom-control-label" for="login-form-rememberme">'.Yii::t('user', 'Remember me next time').'</label></div>{hint}{error}',
            ])->checkbox(['tabindex' => '3', 'class' => 'custom-control-input', 'label' => false]) ?>
        
            <?= Html::submitButton(
                Yii::t('user', 'Sign in'),
                ['class' => 'btn btn-primary btn-lg btn-block', 'tabindex' => '4']
            ) ?>
            <div class="mt-3 text-muted text-center">
                <a href="<?= \yii\helpers\Url::to(['/user/resend']) ?>"><?= Yii::t("user", "Didn't receive confirmation message?") ?></a>
            </div>
            <div class="mt-3 text-muted text-center">
                <?= Yii::t("user", "Don't have an account?") ?> <a href="<?= \yii\helpers\Url::to(['/user/register']) ?>"><?= Yii::t('user', 'Create a user account') ?></a>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<div class="simple-footer">
    Copyright &copy; <?= date('Y') ?> SMKN 2 Jakarta
</div>