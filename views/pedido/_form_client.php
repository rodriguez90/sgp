<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\forms\PedidoForm */
/* @var $form yii\widgets\ActiveForm */

$user = Yii::$app->user;
$identity = null;
$accessCreate = null;
$isAdmin = null;
if($user) {
    $accessCreate = Yii::$app->authManager->checkAccess($user->id, 'pedido/create');
    $isAdmin = Yii::$app->authManager->getAssignment('Administrador', $user->getId());
    $identity = $user->identity;
}
?>

<?php if ($model->hasErrors()) {
    \Yii::$app->getSession()->setFlash('error', $model->getErrorSummary(true));
}
?>

<style>
    #w0{
        margin: 0px !important;
    }
</style>

<!-- begin row -->
<div class="row">
    <!-- begin col-lg-12 -->
    <div class="col-lg-12">
        <!-- begin box -->
        <div class="box box-success">
            <div class="box-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div id="product-grid">
                            <div class="txt-heading">Catálogo de Medicamentos</div>

                            <?php \yii\widgets\Pjax::begin(); ?>

                            <?php

                            echo ListView::widget([
                                'dataProvider' => $medicamentosDataProvider,
                                'itemView' => '_medicamento',
                                'layout' =>"{pager}\n{items}",
                                'options' => [
                                    'tag' => 'div'
                                ],
//                        'viewParams' => [
//                            'fullView' => true,
//                            'context' => 'main-page',
//                        ]
                            ]);
                            ?>
                            <?php \yii\widgets\Pjax::end(); ?>
                        </div>
                    </div>
                </div>

                <?php $form = ActiveForm::begin(); ?>

                <div class="row" style="margin: 10px">
                    <div class="col-lg-12">
                        <div id="shopping-cart">
                            <div class="txt-heading">Pedido</div>
                            <button id="btnEmpty" href="#" onclick="return limpiarPedido()">Limpiar Pedido</button>
                            <table id="data-table" class="display table table-bordered table-condensed no-wrap" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="all">Nombre</th>
                                    <th class="all">Código</th>
                                    <th class="all">Cantidad</th>
                                    <th class="all">Proveedor</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <?php

                echo $form->field($model->pedido, 'usuario_id')
                    ->textInput([
                        'readonly'=>true,
                    ])
                    ->hiddenInput()
                    ->label(false);

                echo $form->field($model->pedido, 'estado')
                    ->textInput([
                        'readonly'=>true,
                    ])
                    ->hiddenInput()
                    ->label(false);

                echo $form->field($model, 'pedidoDetalles')
                    ->textInput([
                        'readonly'=>true,
                    ])
                    ->hiddenInput()
                    ->label(false)
                ?>

                <div class="form-group">
                    <?= Html::submitButton('Guardar', [
                        'id' => 'btnSave',
                        'class' => 'btn btn-success']) ?>

                    <?php
                    if(!$model->isNewRecord && $model->estado === \app\models\Pedido::SOLICITADO) {
                        echo Html::a('Cancelar Pedido', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Usted esta seguro que desea cancelar el pedido?',
                                'method' => 'post',
                            ],
                        ]);

                    }
                    ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

