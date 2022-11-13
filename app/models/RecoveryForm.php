<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Description of RecoveryForm
 *
 * @author Arief
 */
class RecoveryForm extends \dektrium\user\models\RecoveryForm{
    /**
     * @var string
     */
    public $reCaptcha;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = 
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(),
              'secret' => '6LeLMLcUAAAAAFz7ye9EFr3AS1KyA9--Aclc7FPn', // unnecessary if reСaptcha is already configured
              'uncheckedMessage' => 'Please confirm that you are not a bot.'];
        return $rules;
    }
}
