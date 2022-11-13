<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use app\models\Item;
use app\models\ItemMutation;
use Yii;
use yii\httpclient\Exception;

/**
 * Description of BaseMutation
 *
 * @author Computesta
 */
abstract class BaseMutation extends ActiveRecord{
    abstract public function getRelationField();
    
    abstract public function getBalanceAttribute();
    
    public function afterSave($insert, $changedAttributes) {
        if($insert === true){
            $this->saveMutation();
        }else{
            $this->calculateMutation($this->id, $changedAttributes['item_id']);
            $this->saveMutation();
        }
        
        parent::afterSave($insert, $changedAttributes);
    }
    
    public function beforeDelete() {
        $this->calculateMutation($this->id, $this->item_id);
        
        return parent::beforeDelete();
    }
    
    public function validationStock(){
        $item = Item::findOne($this->item_id);
        $tmpStock = $item->stock;
        $balanceAttribute = $this->balanceAttribute;
        
        if(!empty($this) && $this->oldAttributes !== null)
        {
            $tmpStock = $tmpStock + ($this->isNewRecord ? 0 : $this->getOldAttribute('quantity'));
        }

        if(($tmpStock >= $this->quantity && $balanceAttribute == 'credit') || $balanceAttribute == 'debit')
        {
            return true;
        }

        $this->addError('quantity', "Stock barang tersedia kurang dari kuantiti");
    }
    
    public function saveMutation(){
        $relationField = $this->relationField;
        $balanceAttribute = $this->balanceAttribute;
        
        $lastBalance = ItemMutation::getLastBalance($this->item_id);
        
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $mutation = new ItemMutation;
            $mutation->{$relationField} = $this->id;
            $mutation->item_id = $this->item_id;
            $mutation->{$balanceAttribute} = $this->quantity;
            if(!$this->isNewRecord){
                $mutation->created_at = $this->created_at;
                $mutation->created_by = $this->created_by;
                $mutation->updated_at = $this->updated_at;
                $mutation->updated_by = $this->updated_by;
            }

            if($balanceAttribute == 'debit'){
                $mutation->balance = $lastBalance + $this->quantity;
            }else{
                $mutation->balance = $lastBalance - $this->quantity;
            }
            
            $item = Item::findOne($this->item_id);
            $item->stock = $mutation->balance;

            if($mutation->save() && $item->save()){
                $transaction->commit();
            }
        } catch (Exception $ex) {
            $transaction->rollBack();
            Yii::error($ex->getMessage(), 'mutation_create_exception');
        }
    }
    
    public function calculateMutation($relation_id, $item_id){
        $relationField = $this->relationField;
        
        //ambil id mutasi dari relasi
        $targetID = ItemMutation::find()->where([$relationField => $relation_id])->one()->created_at;
        
        // ambil semua mutasi dari id tersebut sampai mutasi paling terakhir dari item_id tersebut
        $itemMutations = ItemMutation::find()
                ->where(['>=', 'created_at', $targetID])
                ->andWhere(['item_id' => $item_id])->orderBy(['id' => SORT_ASC])->all();
        
        
        $lastStock = 0;
        // hapus record dan hitung ulang saldo mutasi
        foreach($itemMutations as $key => $itemMutation){
            if($key == 0){
                // kembalikan stock
                $lastStock = $itemMutation->balance - $itemMutation->debit + $itemMutation->credit;
                
                if($item_id == $itemMutation->item_id){
                    $item = Item::findOne($itemMutation->item_id);
                    $item->stock = $lastStock;
                    $item->save();
                    
                    $itemMutation->delete();
                }
                continue;
            }
            
            $itemMutation->balance = $lastStock + $itemMutation->debit - $itemMutation->credit;
            $lastStock = $itemMutation->balance;
            
            $item = Item::findOne($itemMutation->item_id);
            $item->stock = $lastStock;
            $item->save();
            
            $itemMutation->save();
        }
    }
}
