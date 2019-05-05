<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 29/04/2019
 * Time: 13:32
 */

use yii\helpers\Html;
/* @var $model app\models\Medicamento */

?>

<div class="medicamento-item">
    <form method="post" action="#" onsubmit="return agregarMedicamento(<?php echo $model->id ?>)">
        <div class="medicamento-image"><img width="250" height="155" src="<?php echo \yii\helpers\Url::toRoute($model->imagen == null || $model->imagen == '' ? 'medicamento-images/medicamento.jpg'  : $model->imagen); ?>"></div>
        <div class="card-footer">
            <div class="medicamento-nombre"><?php echo $model->nombre; ?></div>
            <div class="medicamento-codigo"><?php echo $model->codigo; ?></div>
            <div class="cart-action">
                <input id="<?php echo 'product-quantity-' . $model->id?>" type="number" class="medicamento-cantidad" name="quantity" value="1" min="1"/>
                <input type="submit" value="Añadir al Pedido" class="btnAddAction" />
            </div>
        </div>
    </form>
</div>