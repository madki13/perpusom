<?php

use dmstr\widgets\Menu;
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;
?>
<aside class="main-sidebar">

    <section class="sidebar">
        <?= Menu::widget([
            'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id),
            'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
        ]);
        ?>

    </section>

</aside>