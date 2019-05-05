<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TipoMedicamento */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Medicamentos', 'url' => ['index']];
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
                        'nombre',
                        [
                            'attribute'=>'activo',
                            'format'=> 'raw',
                            'value'=>  Html::label($model->activo ? 'Activo': 'Inactivo' , null, ['class'=> $model->activo ? 'text-green': 'text-red'])
                        ],
                        'descripcion:ntext',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>

