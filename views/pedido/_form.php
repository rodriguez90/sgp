<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */
?>

<!-- begin row -->
<div class="row">
    <!-- begin col-lg-12 -->
    <div class="col-lg-12">
        <!-- begin box -->
        <div class="box box-success">
            <div class="box-body">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'estado')->textInput() ?>

                <?= $form->field($model, 'usuario_id')->textInput() ?>

                <?= $form->field($model, 'fecha_registro')->textInput() ?>

                <?= $form->field($model, 'fecha_entrega')->textInput() ?>

                <?= $form->field($model, 'observacion')->textarea(['rows' => 6]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
