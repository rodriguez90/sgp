<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\forms\PedidoForm */

$this->title = 'Nuevo Pedido';
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-create">

    <?= $this->render('_form_client', [
        'model' => $model,
        'searchModel' => $searchModel,
        'medicamentosDataProvider' => $medicamentosDataProvider,
    ]) ?>

</div>

<?php $this->registerJsFile('@web/js/pedido/create.js', ['depends' => ['app\assets\DataTableAsset']]) ?>
