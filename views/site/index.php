<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';

$user = Yii::$app->user;
$createPedido = false;
if($user && Yii::$app->authManager->checkAccess($user->getId(),'pedido/create'))
    $createPedido = true;
?>

<section class="content">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pedidos</span>
                    <span id="totalElectores" class="info-box-number"><?=$totalPedidos?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-bag"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pedidos Pendientes</span>
                    <span id="totalVotosBlancos"  class="info-box-number"><?= $totalPedidosPendientes ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Proveedores</span>
                    <span id="totalVotos" class="info-box-number"><?=$totalProveedores?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-circle-filled"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Medicamentos</span>
                    <span id="totalVotosNulos" class="info-box-number"><?= $totalMedicamentos ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">

                <div class="box-header">

                    <p>
                        <?php
                        if($createPedido)
                            echo Html::a('Nuevo Pedido', \yii\helpers\Url::toRoute(['pedido/create']), ['class' => 'btn btn-success'])
                        ?>
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

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'controller' => 'pedido',
                            ]
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>

</section>

