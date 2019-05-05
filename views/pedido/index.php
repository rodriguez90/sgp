<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">

                <p>
                    <?= Html::a('Nuevo Pedido', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
            </div>

            <div class="box-body">
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'id',
                        [
                            'attribute'=>'estado',
                            'format'=> 'raw',
                            'value'=>  function($model) {
                                return Html::label( \app\models\Pedido::ESTADOS_LABEL[$model->estado], null, ['class'=>  'text-green']);
                            },
                            'filter' => \app\models\Pedido::ESTADOS_LABEL
                        ],
                        'observacion:ntext',
                        [
                            'attribute' =>'usuario',
                            'value' => function(\app\models\Pedido $model){
                                return $model->getNombreUsuario();
                            }
                        ],
                        'fecha_registro:datetime',
                        [
                            'attribute'=>'fecha_entrega',
                            'format'=> 'datetime',
                            'value'=> function($model) {
                                return $model->estado === \app\models\Pedido::ENTREGADO ? date('d-m-Y H:i', $model->fecha_entrega) : null;
                            }
                        ],

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
