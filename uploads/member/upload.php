<?php 

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\validators\FileValidator;

class UploadForm extends Model{
    
    public $photo;

    public function rules()
    {
        return [
            [['photo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
        ];
    }
    public function upload(){
        
        if ($this->validate()) {
            $this->photo->saveAs('upload/' .$this->photo->basename . '.' . $this->photo->extension);
            return true;
        } else {
            return false;
        }
    }
}