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

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'codigo',
                        'nombre',
                        'indicacion:ntext',
                        'contraindicacion:ntext',
                        'observacion:ntext',
                        'stock',
                        'proveedor_id',
                        'tipo_id',
                        'fecha_registro',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
