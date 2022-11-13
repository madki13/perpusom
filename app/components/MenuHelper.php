<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use mdm\admin\components\MenuHelper as BaseMenuHelper;

/**
 * Description of MenuHelper
 *
 * @author Arief
 */
class MenuHelper extends BaseMenuHelper{
    
    /**
     * Use to get assigned menu of user.
     * @param mixed $userId
     * @param integer $root
     * @param \Closure $callback use to reformat output.
     * callback should have format like
     * 
     * ```
     * function ($menu) {
     *    return [
     *        'label' => $menu['name'],
     *        'url' => [$menu['route']],
     *        'options' => $data,
     *        'items' => $menu['children']
     *        ]
     *    ]
     * }
     * ```
     * @param boolean  $refresh
     * @return array
     */
    public static function getAssignedMenu($userId, $root = null, $callback = null, $refresh = false)
    {
        $result = '<ul class="sidebar-menu">';
        $result .= '<li class="menu-header">Main menu</li>';
        $menus = parent::getAssignedMenu($userId, $root, $callback, $refresh);
//        var_dump($menus);die;
        foreach($menus as $menu){
            $active = "";
            $currentRoute = [
                "/" . \Yii::$app->controller->id . "/" . \Yii::$app->controller->action->id
            ];
            if(isset($menu['items'])){
                foreach($menu['items'] as $item){
                    if($item['url'] == $currentRoute){
                        $active = " active";
                    }
                }
                
                $result .= '
                    <li class="nav-item dropdown'.$active.'">
                        <a href="#" class="nav-link has-dropdown"><i class="far fa-circle"></i><span>'.$menu['label'].'</span></a>
                        <ul class="dropdown-menu" style="display: none;">
                ';
                foreach($menu['items'] as $item){
                    if($item['url'] == $currentRoute){
                        $result .= '<li class="active"><a class="nav-link" href="'.\yii\helpers\Url::to($item['url']).'">'.$item['label'].'</a></li>';
                    }else{
                        $result .= '<li><a class="nav-link" href="'.\yii\helpers\Url::to($item['url']).'">'.$item['label'].'</a></li>';
                    }
                }
                $result .= '
                        </ul>
                    </li>
                ';
            }else{
                if($menu['url'] == $currentRoute){
                    $result .= '<li class="active"><a class="nav-link" href="'.\yii\helpers\Url::to($menu['url']).'"><i class="far fa-circle"></i> <span>'.$menu['label'].'</span></a></li>';
                }else{
                    $result .= '<li><a class="nav-link" href="'.\yii\helpers\Url::to($menu['url']).'"><i class="far fa-circle"></i> <span>'.$menu['label'].'</span></a></li>';
                }
            }
        }
        
        $result .= '</ul>';
        
        return $result;
    }
    
    /**
     * Use to get assigned menu of user.
     * @param mixed $userId
     * @param integer $root
     * @param \Closure $callback use to reformat output.
     * callback should have format like
     * 
     * ```
     * function ($menu) {
     *    return [
     *        'label' => $menu['name'],
     *        'url' => [$menu['route']],
     *        'options' => $data,
     *        'items' => $menu['children']
     *        ]
     *    ]
     * }
     * ```
     * @param boolean  $refresh
     * @return array
     */
    public static function getAssignedUserMenu($userId, $root = null, $callback = null, $refresh = false)
    {
        $result = '<ul class="navbar-nav">';
        $menus = parent::getAssignedMenu($userId, $root, $callback, $refresh);
//        var_dump($menus);die;
        foreach($menus as $menu){
            if(isset($menu['items'])){
                
                $result .= '
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link has-dropdown">'.$menu['label'].'</a>
                        <ul class="dropdown-menu" style="display: none;">
                ';
                foreach($menu['items'] as $item){
                        $result .= '<li><a class="nav-link" href="'.\yii\helpers\Url::to($item['url']).'">'.$item['label'].'</a></li>';
                }
                $result .= '
                        </ul>
                    </li>
                ';
            }else{
                $result .= '<li class="nav-item"><a class="nav-link" href="'.\yii\helpers\Url::to($menu['url']).'">'.$menu['label'].'</a></li>';
            }
        }
        
        $result .= '</ul>';
        
        return $result;
    }
}
