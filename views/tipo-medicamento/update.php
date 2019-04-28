<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoMedicamento */

$this->title = 'Modificar Tipo Medicamento: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Medicamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="tipo-medicamento-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
