<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = 'Pedido: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">

                <p>
                    <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Usted esta seguro que desea eliminar el elemento?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-lg-12">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'id',
                                [
                                    'attribute'=>'estado',
                                    'format'=> 'raw',
                                    'value'=>  Html::label( \app\models\Pedido::ESTADOS_LABEL[$model->estado], null, ['class'=>  'text-green'])
                                ],
                                'observacion:ntext',
                                'usuario_id',
                                'fecha_registro:datetime',

                                [
                                    'attribute'=>'fecha_entrega',
                                    'format'=> 'datetime',
                                    'value'=> $model->estado === \app\models\Pedido::ENTREGADO ? date('d-m-Y H:i', strtotime($model->fecha_entrega)) : null
                                ],
                            ],
                            'options'=>['class' => 'table table-striped table-bordered table-condensed detail-view'],
                        ]) ?>
                    </div>
                </div>

                <div class="row" style="margin: 10px">
                    <div class="col-lg-12">
                        <div id="shopping-cart">
                            <div class="txt-heading">Medicamentos</div>
                            <table id="data-table" class="display table table-bordered table-condensed no-wrap" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="all">Nombre</th>
                                    <th class="all">Código</th>
                                    <th class="all">Cantidad</th>
                                    <th class="all">Proveedor</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    var pedidoId = '<?php echo $model->id; ?>';
</script>

<?php $this->registerJsFile('@web/js/pedido/view.js', ['depends' => ['app\assets\DataTableAsset']]) ?>