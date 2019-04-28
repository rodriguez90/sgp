<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoMedicamento */

$this->title = 'Nuevo Tipo Medicamento';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Medicamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-medicamento-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
