<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoMedicamento */
/* @var $form yii\widgets\ActiveForm */
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

                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
