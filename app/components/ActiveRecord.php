<?php
namespace app\components;

use app\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord as BaseActiveRecord;
use yii\db\Expression;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ActiveRecord extends BaseActiveRecord{
    public function init(){
        $this->on(self::EVENT_AFTER_FIND, [$this, 'dateRestore']);
        $this->on(self::EVENT_AFTER_REFRESH, [$this, 'dateRestore']);
        
        parent::init();
    }
    
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => date('Y-m-d H:m:s'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCreatedBy() {
            return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCreatedAt() {
            return self::getIndonesianDate($this->created_at);
    }

    /**
     * @return ActiveQuery
     */
    public function getUpdatedAt() {
            return self::getIndonesianDate($this->updated_at);
    }
    
    public function dateFormat($attribute){
        $date = \DateTime::createFromFormat("d/m/Y", $this->$attribute);
        $this->$attribute = $date->format('Y-m-d');
    }
    
    public function dateRestore(){
        $rules = $this->rules();
        
        foreach($rules as $rule){
            if($rule[1] == 'dateformat'){
                foreach($rule[0] as $attribute){
//                    var_dump($this->$attribute);die;
                    $this->$attribute = date('d/m/Y', strtotime($this->$attribute));
                }
            }
        }
    }
    
    public function formatDate($attribute){
        $date = \DateTime::createFromFormat("d/m/Y", $this->$attribute);
        if(empty($date)){
            return null;
        }
        return $date->format('Y-m-d');
    }

    /**
     * @return ActiveQuery
     */
    public function getUpdatedBy() {
            return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    
    public function removeMasked($attribute){
//        $this->$attribute = preg_replace('/\D/', '', $this->$attribute);
        $this->$attribute = str_replace(",","",$this->$attribute);
    }
    
    public static function dataList(){
        $className = self::className();
        return \yii\helpers\ArrayHelper::map(self::find()->asArray()->all(), 'id', $className::$dataListAttribute);
    }
    
    public static function listIndonesianMonth(){
        return [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
    }
    
    public static function getIndonesianDate($targetDate, $format = 'Y-m-d H:i:s', $long=true){
        $date = \DateTime::createFromFormat($format, $targetDate)->format('Y-m-d H:i:s');
        if($long){
            return date('d', strtotime($date)) . " " . self::listIndonesianMonth()[date('n', strtotime($date))] . " " . date('Y', strtotime($date)) . " " . date('H:i:s', strtotime($date));
        }else{
            return date('d', strtotime($date)) . " " . self::listIndonesianMonth()[date('n', strtotime($date))] . " " . date('Y', strtotime($date));
        }
    }
}