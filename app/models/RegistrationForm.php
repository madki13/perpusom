<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use dektrium\user\models\Profile;
use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use dektrium\user\models\User;
use Yii;
use yii\debug\models\search\Profile as Profile2;

class RegistrationForm extends BaseRegistrationForm
{
    /**
     * @var string
     */
//    public $reCaptcha;
    
    /**
     * @var string
     */
    public $name;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
//        $rules[] = [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(),
//              'secret' => '6LeLMLcUAAAAAFz7ye9EFr3AS1KyA9--Aclc7FPn', // unnecessary if reСaptcha is already configured
//              'uncheckedMessage' => 'Please confirm that you are not a bot.'];
        
        $rules[] = ['name', 'required'];
        $rules[] = ['name', 'string', 'max' => 255];
        
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['name'] = Yii::t('user', 'Name');
        return $labels;
    }

    /**
     * @inheritdoc
     */
    public function loadAttributes(User $user)
    {
        // here is the magic happens
        $user->setAttributes([
            'email'    => $this->email,
            'username' => $this->username,
            'password' => $this->password,
        ]);
        /** @var Profile2 $profile */
        $profile = Yii::createObject(Profile::className());
        $profile->setAttributes([
            'name' => $this->name,
        ]);
        $user->setProfile($profile);
    }

    /**
     * Registers a new user account. If registration was successful it will set flash message.
     *
     * @return bool
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        /** @var User $user */
        $user = Yii::createObject(User::className());
        $user->setScenario('register');
        $this->loadAttributes($user);

        if (!$user->register()) {
            return false;
        }

        Yii::$app->session->setFlash(
            'info',
            Yii::t(
                'user',
                'Akun anda berhasil dibuat dan pesan dengan instruksi lebih lanjut telah dikirim ke email anda yang tercantum'
            )
        );

        return true;
    }
}