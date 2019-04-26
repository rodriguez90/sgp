<?php
$items = [['label' => 'Menu', 'options' => ['class' => 'header']]];

$identity = Yii::$app->user->identity;
if(Yii::$app->authManager->getAssignment('admin',Yii::$app->user->getId()) || ($identity != null && $identity->getIsAdmin()))
{
    $items[]=['label' => 'Administración', 'icon' => 'cogs', 'url' => ['/user/admin/index']];
}

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $items
            ]
        ) ?>

    </section>

</aside>
