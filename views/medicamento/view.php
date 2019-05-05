<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Medicamento */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Medicamentos', 'url' => ['index']];
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
                    <div class="col-lg-4">
                        <div class="medicamento-item" style="margin: 0px !important;">
                            <div class="medicamento-image"><img width="255" height="155" src="<?php echo \yii\helpers\Url::toRoute($model->imagen == null || $model->imagen == '' ? 'medicamento-images/medicamento.jpg'  : $model->imagen); ?>"></div>
                            <div class="card-footer">
                                <div class="medicamento-nombre"><?php echo $model->nombre; ?></div>
                                <div class="medicamento-codigo"><?php echo $model->codigo; ?></div>
                                <div class="cart-action">
                                    <label> Stock: <?php echo $model->stock ?> </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'id',
                                'codigo',
                                'nombre',
                                [
                                    'attribute'=>'activo',
                                    'format'=> 'raw',
                                    'value'=>  Html::label($model->activo ? 'Activo': 'Inactivo', null, ['class'=> $model->activo ? 'text-green': 'text-red'])
                                ],
                                'indicacion:ntext',
                                'contraindicacion:ntext',
                                'observacion:ntext',
                                'stock',
                                [
                                    'attribute' => 'nombreProveedor',
                                    'label'=> 'Proveedor'
                                ],
                                [
                                    'attribute' => 'nombreTipo',
                                    'label'=> 'Tipo'
                                ],
                                'fecha_registro:date',
                            ],
                            'options'=>['class' => 'table table-striped table-bordered table-condensed detail-view'],
                        ]) ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
