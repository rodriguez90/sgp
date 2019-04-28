<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MedicamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medicamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">
                <p>
                    <?= Html::a('Nuevo Medicamento', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'nombre',
//                        'indicacion:ntext',
//                        'contraindicacion:ntext',
                        //'observacion:ntext',
                        'stock',
                        'proveedor_id',
                        'tipo_id',
                        //'fecha_registro',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
