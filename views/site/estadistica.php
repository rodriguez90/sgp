<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MedicamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estadísticas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">
            </div>
            <div class="box-body">

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'id',
                        'nombre',
                        'codigo',
//                        'indicacion:ntext',
//                        'contraindicacion:ntext',
                        //'observacion:ntext',
                        [
                            'attribute'=>'activo',
                            'format'=> 'raw',
                            'value'=>function(\app\models\Medicamento $modelo) {
                                $html = Html::label($modelo->activo ? 'Activo': 'Inactivo', null, ['class'=>$modelo->activo ? 'text-green': 'text-red']);
                                return $html;
                            },
                            'filter' => \app\models\Medicamento::ESTADOS_LABEL
                        ],
                        'stock',
                        [
                            'attribute' => 'nombreProveedor',
                            'label'=> 'Proveedor'
                        ],
                        [
                            'attribute' => 'nombreTipo',
                            'label'=> 'Tipo'
                        ],
                        //'fecha_registro',
                        [
                            'attribute' => 'cantidadPedidos',
                            'label' => 'Demanda'
                        ],
                        [
                            'attribute' => 'total',
                            'label' => 'Total'
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view}'
                        ],
                    ],
                    'options'=>['class' => 'table table-striped table-bordered table-condensed detail-view'],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
