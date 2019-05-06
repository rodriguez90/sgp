<?php

$items = [['label' => 'Menu',
    'options' => ['class' => 'header'],
    'items' =>[]
]];

$administracion = [
    'label' => 'Administración',
    'icon' => 'cogs',
    'url' => '#',
    'items' => []
];

$user = Yii::$app->user;

if($user == null) return;

$identity = $user->identity;

if($identity == null) return;

if(Yii::$app->authManager->checkAccess($user->getId(),'site/index') ||
    $identity->getIsAdmin())
{
    $items[]=['label' => 'Inicio', 'icon' => 'home', 'url' => ['/site/index']];
}

if(Yii::$app->authManager->checkAccess($user->getId(),'pedido/index') ||
    $identity->getIsAdmin())
{
    $items[]=['label' => 'Pedidos', 'icon' => 'shopping-cart', 'url' => ['/pedido/index']];
}

if(Yii::$app->authManager->checkAccess($user->getId(),'pedido/index') ||
    $identity->getIsAdmin())
{
    $items[]=['label' => 'Estadísticas', 'icon' => 'area-chart', 'url' => ['/site/estadisticas']];
}

if($identity->getIsAdmin())
{
    if(Yii::$app->authManager->checkAccess($user->getId(),'tipo-medicamento/index') ||
        $identity->getIsAdmin())
    {
        $administracion['items'][]=['label' => 'Tipo Medicamentos', 'icon' => 'bookmark', 'url' => ['/tipo-medicamento/index']];
    }

    if(Yii::$app->authManager->checkAccess($user->getId(),'medicamento/index') ||
        $identity->getIsAdmin())
    {
        $administracion['items'][]=['label' => 'Medicamentos', 'icon' => 'medkit', 'url' => ['/medicamento/index']];
    }

    if(Yii::$app->authManager->getAssignment('Administrador',$user->getId()) ||
        ($identity != null && $identity->getIsAdmin()))
    {
        $administracion['items'][]=['label' => 'Usuarios & Permisos', 'icon' => 'wrench', 'url' => ['/user/admin/index']];
    }

    $items[]= $administracion;
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
