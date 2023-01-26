<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;

class SiteController extends Controller{
    public function actionUpload(){
        $model = new UploadForm();

        if (yii::$app->request->isPost) {
            $model->photo = UploadedFile::getInstance($model, 'photo');
            if ($mode   l->upload()) {
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
}