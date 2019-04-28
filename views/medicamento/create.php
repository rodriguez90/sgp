<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Medicamento */

$this->title = 'Nuevo Medicamento';
$this->params['breadcrumbs'][] = ['label' => 'Medicamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medicamento-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
