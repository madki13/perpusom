<?php

use app\models\Member;
use Faker\Core\Number;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap4\BootstrapWidgetTrait;
use yii\bootstrap4\Dropdown;


/* @var $this yii\web\View */
/* @var $model app\models\Member */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="card">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'email')->textInput() ?>
                    <?= $form->field($model, 'date_of_birth')->textInput(['maxlength' => true, "type" => 'date']) ?>
                    <?= $form->field($model, 'type')->dropDownList(Member::listType(),['prompt'=>'Silakan Pilih']) ?>
                    <?php //<?= $form->field($model, 'photo')->fileInput(["multiple"=> true,"accept"=>"image/*" ]) ?> 
                    <?php // <?= $form->field($model, 'code')->textInput() ?>
                    <?php // <?= $form->field($model, 'join_date')->textInput()   ?> 
                    <?php // <?= $form->field($model, 'expired_date')->textInput() ?>

                    </div>
                    <div class="col-6">
                    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>    
                    <?php // <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                    <?php //<?= $form->field($model, 'phone')->textInput(['maxlength' => '12', "type"=>'number']) ?> 
                    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class,[
                        'mask' => '9999-9999-9999',
                    ]) ?>
                    <?= $form->field($model, 'gender')->dropDownList(Member::listGender(),['prompt'=>'Silakan Pilih']); ?>
                    <?= $form->field($model, 'status')->dropDownList(Member::listStatus()) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

