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
 * @var dektrium\user\models\ResendForm $model
 */

$this->title = Yii::t('user', 'Request new confirmation message');
$this->params['breadcrumbs'][] = $this->title;
$this->context->layout = "@app/themes/stisla/layouts/main-login";
?>
<div class="card card-default">
    <div class="card-header">
        <h4><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'id' => 'resend-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
        ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= Html::submitButton(Yii::t('user', 'Continue'), ['class' => 'btn btn-primary btn-block']) ?><br>

        <?php ActiveForm::end(); ?>
    </div>
</div>
