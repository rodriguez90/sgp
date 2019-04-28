<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = 'Modificar Pedido: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="pedido-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
