<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

<!-- begin row -->
<div class="row">
    <!-- begin col-lg-12 -->
    <div class="col-lg-12">
        <!-- begin box -->
        <div class="box box-success">
            <div class="box-body">

                <?php $form = ActiveForm::begin(); ?>

                <div class="row">
                    <div class="col-lg-3">
                        <?= $form->field($model->pedido, 'usuario_id')->textInput()->hiddenInput()->label(false) ?>
                        <?= Html::label('Usuario: ' . $model->usuario->username) ?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($model->pedido, 'fecha_registro')->textInput()->hiddenInput()->label(false) ?>
                        <?= Html::label('Fecha Soliciud: ' . date('d-m-Y H:i', strtotime($model->fecha_registro))) ?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($model->pedido, 'fecha_entrega')->textInput()->hiddenInput()->label(false) ?>
                        <?= Html::label('Fecha Entrega: ' . (strtotime($model->fecha_entrega) !== false ? date('d-m-Y H:i', strtotime($model->fecha_entrega)) : '-')) ?>
                    </div>

                    <div class="col-lg-3">
                        <?php if(!$model->isNewRecord)

                            echo $form->field($model->pedido, 'estado')->dropDownList(
                                \yii\helpers\ArrayHelper::map(\app\models\Pedido::ESTADOS_CHOICES,'id','name'),
                                ['prompt'=>'Seleccione el Estado',
                                ]);
                        ?>
                    </div>
                </div>

                <div class="col-lg-12">
                    <?= $form->field($model->pedido, 'observacion')->textarea(['rows' => 6]) ?>
                </div>

                <div class="row" style="margin: 10px">
                    <div class="col-lg-12">
                        <div id="shopping-cart">
                            <div class="txt-heading">Medicamentos</div>
                            <table id="data-table" class="display table table-bordered table-condensed no-wrap" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="all">Nombre</th>
                                    <th class="all">Código</th>
                                    <th class="all">Cantidad</th>
                                    <th class="all">Proveedor</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

<script>
    var pedidoId = '<?php echo $model->pedido->id; ?>';
</script>

<?php $this->registerJsFile('@web/js/pedido/update.js', ['depends' => ['app\assets\DataTableAsset']]) ?>
