<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoMedicamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos de Medicamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">
                <p>
                    <?= Html::a('Nuevo Tipo Medicamento', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'nombre',
                        [
                            'attribute'=>'activo',
                            'format'=> 'raw',
                            'value'=>function(\app\models\TipoMedicamento $modelo) {
                                $html = Html::label($modelo->activo ? 'Activo': 'Inactivo' , null, ['class'=>$modelo->activo ? 'text-green': 'text-red']);
                                return $html;
                            },
                            'filter' => \app\models\TipoMedicamento::ESTADOS_LABEL
                        ],
                        'descripcion:ntext',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
