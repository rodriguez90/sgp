<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Medicamento */
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

                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model, 'proveedor_id')->widget(\kartik\select2\Select2::classname(), [
                            'data' =>  \yii\helpers\ArrayHelper::map(\Da\User\Model\Profile::find()
                                ->innerJoin('auth_assignment', 'profile.user_id=auth_assignment.user_id and auth_assignment.item_name="Proveedor"')
                                ->asArray()
                                ->all(),'user_id','name'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Seleccione el Proveedor.',
                                'onchange'=>'                                        
                                                                             
                                        '
                            ],
                            'pluginOptions' => [
                                'allowClear' => false
                            ],
                        ]);?>
                    </div>

                    <div class="col-lg-4">
                        <?= $form->field($model, 'tipo_id')->widget(\kartik\select2\Select2::classname(), [
                            'data' =>  \yii\helpers\ArrayHelper::map(\app\models\TipoMedicamento::find()
                                ->where(['activo'=>1    ])
                                ->asArray()
                                ->all(),'id','nombre'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Seleccione el Tipo.',
                                'onchange'=>''
                            ],
                            'pluginOptions' => [
                                'allowClear' => false
                            ],
                        ]);?>
                    </div>

                    <div class="col-lg-4">
                        <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-4">

                        <?= $form->field($model, 'stock')->textInput() ?>

                    </div>

                    <div class="col-lg-4">

                        <?php
                        if($model->isNewRecord)
                        {
                            $model->activo = true;
                        }
                        echo $form->field($model, 'activo')->widget(\kartik\widgets\SwitchInput::className(),[
                            'bsVersion' => '3.x',
                            'inlineLabel'=>false,
                            'pluginOptions'=>[
                                'size'=>'mini',
                                'onText'=>'Activo',
                                'offText'=>'Inactivo',
                                'onColor'=>'success',
                                'offColor'=>'danger',
                            ],
                        ]);
                        ?>

                        <?php echo $form->field($model, "imagen")->fileInput([
                            'multiple' => false,
                            'required'=> false,
                            'value' => $model->imagen
                        ]); ?>
                    </div>

                </div>

                <div class="row" >
                    <div class="col-lg-4">

                        <?= $form->field($model, 'indicacion')->textarea(['rows' => 6]) ?>
                    </div>

                    <div class="col-lg-4">
                        <?= $form->field($model, 'contraindicacion')->textarea(['rows' => 6]) ?>
                    </div>

                    <div class="col-lg-4">
                        <?= $form->field($model, 'observacion')->textarea(['rows' => 6]) ?>
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
