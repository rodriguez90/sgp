<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\forms\PedidoForm */

$this->title = 'Modificar Pedido: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="pedido-update">

    <?= $this->render('_form_client', [
        'model' => $model,
        'searchModel' => $searchModel,
        'medicamentosDataProvider' => $medicamentosDataProvider,
    ]) ?>

</div>

<script>
    var pedidoId = '<?php echo $model->pedido->id; ?>';
</script>

<?php $this->registerJsFile('@web/js/pedido/update-client.js', ['depends' => ['app\assets\DataTableAsset']]) ?>
