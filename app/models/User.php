<?php

namespace app\models;

use DateTime;
use dektrium\user\helpers\Password;
use dektrium\user\models\User as BaseUser;
use Yii;
use yii\helpers\ArrayHelper;

class User Extends BaseUser {
    /**
     * Get Access Token
     * first run user findOne or findByCondition, etc
     * update access token if value is null
     * @return string
     */
    public function getAccessToken() {
        // hanya bisa digunakan setelah load id
        if ($this->id == false) {
            return false;
        }

        // jika access_token ada nilainya, langsung kembalikan
        if ($this->access_token != false) {
            return $this->access_token;
        }

        // jika masih kosong, update nilainya, lalu kembalikan
        $this->access_token = sha1(uniqid());
        $this->save();

        return $this->access_token;
    }
    
    public function rules() {
        return array_merge(parent::rules(), [
            'roleSafe' => ['role', 'safe'],
        ]);
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'username' => 'Nama Pengguna',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'device_token' => 'Device Token',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'flags' => 'Flags',
            'last_login_at' => 'Last Login At',
        ];
    }

    /**
     * Creates new user account. If Module::enableGeneratingPassword is set true, this method
     * will generate password.
     *
     * @return bool
     */
    public function create()
    {
        if ($this->getIsNewRecord() == false) {
            throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
        }

        $transaction = $this->getDb()->beginTransaction();

        try {
            $this->password = ($this->password == null && $this->module->enableGeneratingPassword) ? Password::generate(8) : $this->password;

            $this->trigger(self::BEFORE_CREATE);

            if (!$this->save()) {
                $transaction->rollBack();
                return false;
            }
            
            $auth = Yii::$app->authManager;
            $auth->assign($auth->getRole($this->role), $this->id);

            $this->confirm();

//            $this->mailer->sendWelcomeMessage($this, null, true);
            $this->trigger(self::AFTER_CREATE);

            $transaction->commit();

            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            \Yii::warning($e->getMessage());
            throw $e;
        }
    }
    
    public static function listRole(){
        $model = Yii::$app->db->createCommand("SELECT * FROM `auth_item` WHERE type = 1 AND name NOT IN('developer', 'guest')")->queryAll();
        return ArrayHelper::map($model, 'name', 'name');
    }
    
    public static function timeAgo($time, $full=false){
        $now = new DateTime;
        $ago = new DateTime(date('Y-m-d H:i:s', $time));
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'min',
            's' => 'sec',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
