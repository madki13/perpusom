<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use mdm\widgets\TabularInput as baseTabularInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
/**
 * Description of TabularInput
 *
 * @author Computesta
 */
class TabularInput extends baseTabularInput
{
    /**
     * @inheritdoc
     */
    public function renderItem($model, $key, $index)
    {
        $params = array_merge([
            'model' => $model,
            'item' => $this->renderModel($key),
            'key' => $key,
            'index' => $index,
            'widget' => $this,
            'form' => $this->form,
            ], $this->viewParams);

        // render content
        if ($this->itemView === null) {
            $content = $this->_templateFile ? $this->template($params) : $key;
        } elseif (is_string($this->itemView)) {
            $content = $this->getView()->render($this->itemView, $params);
        } else {
            $content = call_user_func($this->itemView, $model, $key, $index, $this);
        }
        $options = $this->itemOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        if ($tag === false) {
            return $content;
        }
        $options['data-key'] = (string) $key;
        $options['data-index'] = (string) $index;
        return Html::tag($tag, $content, $options);
    }
    
    public function renderModel($key){
        foreach($this->allModels as $index => $model){
            if($key == $index){
                return $model;
            }
        }
    }
}
