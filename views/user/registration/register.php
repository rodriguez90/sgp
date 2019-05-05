<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                   $this
 * @var \Da\User\Form\RegistrationForm $model
 * @var \Da\User\Model\User            $user
 * @var \app\models\Docente            $docente
 * @var \Da\User\Module                $module
 */

$this->title = Yii::t('usuario', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
//var_dump($model->formName());die;
?>

<?php if ($model->hasErrors()) {
    \Yii::$app->getSession()->setFlash('error', $model->getErrorSummary(true));
}
?>

<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(
                    [
                        'id' => $model->formName(),
                        'enableAjaxValidation' => false,
                        'enableClientValidation' => false,
//                        'action' => \yii\helpers\Url::to(['registro/register'])
                    ]
                ); ?>

                <?= $form->field($model->user, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model->user, 'username') ?>

                <?php if ($module->generatePasswords == false): ?>
                    <?= $form->field($model->user, 'password')->passwordInput() ?>
                <?php endif ?>

                <?= $form->field($model->profile, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model->informacionContacto, 'telefono')->textInput(['maxlength' => true]) ?>

                <div class="col-lg-12">
                    <?= $form->field($model->informacionContacto, 'direccion')->textarea(['rows' => 6]) ?>
                </div>


                <?= Html::submitButton(Yii::t('usuario', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <?= Html::a(Yii::t('usuario', 'Already registered? Sign in!'), ['/user/security/login']) ?>
        </p>
    </div>
</div>
