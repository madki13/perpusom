<?php

/**
 * This is the model class for table "profile".
 *
 * @property string $photo
 * 
 */

namespace app\models;

use dektrium\user\models\Profile as BaseProfile;
use yii\web\UploadedFile;

/**
 * Description of Profile
 *
 * @author Arief
 */
class Profile extends BaseProfile{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'bioString'            => ['bio', 'string'],
            'timeZoneValidation'   => ['timezone', 'validateTimeZone'],
            'publicEmailPattern'   => ['public_email', 'email'],
            'gravatarEmailPattern' => ['gravatar_email', 'email'],
            'websiteUrl'           => ['website', 'url'],
            'nameLength'           => ['name', 'string', 'max' => 255],
            'publicEmailLength'    => ['public_email', 'string', 'max' => 255],
            'gravatarEmailLength'  => ['gravatar_email', 'string', 'max' => 255],
            'locationLength'       => ['location', 'string', 'max' => 255],
            'websiteLength'        => ['website', 'string', 'max' => 255],
            'photoString'          => ['photo', 'string', 'max' => 500],
        ];
    }
    
    public function uploadFile(){
        $photo = UploadedFile::getInstance($this, 'photo');
        if (!empty($photo)) {
            if(!in_array($photo->extension, ["png", "jpg"])){
                $this->addError("photo", "File hanya diperbolehkan png dan jpg");
                return false;
            }
            $tmpFilename = md5($photo->baseName) . '_' . time() . '.' . $photo->extension;
            if($photo->saveAs('uploads/photo/' . $tmpFilename)){
                $this->photo = $tmpFilename;
            }
        }
        return true;
    }
}
