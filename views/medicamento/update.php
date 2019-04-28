<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Medicamento */

$this->title = 'Modificar Medicamento: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Medicamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="medicamento-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
