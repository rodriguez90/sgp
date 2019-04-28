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
                        'codigo',
                        'estado',
                        'observacion:ntext',
                        'usuario_id',
                        //'fecha_registro',
                        //'fecha_entrega',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
