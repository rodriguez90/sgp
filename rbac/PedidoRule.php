<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 15/11/2018
 * Time: 11:09
 */

namespace app\rbac;
use app\models\Pedido;
use app\models\PedidoDetalle;
use yii\rbac\Item;
use yii\rbac\Rule;
use app\models\Payment;


class PedidoRule extends Rule
{
    public $name = 'isCollector';

    public function execute($user, $item, $params)
    {
        $result = false;
        // TODO: Implement execute() method.
//        var_dump('in rule');
//        var_dump($user);
//        var_dump($params);

        if(\Yii::$app->authManager->getAssignment('admin', $user)
            || \Yii::$app->authManager->getAssignment('Administrador', $user))
        {
                $result = true;
        }
		else if( isset($params['pedidos']))
        {
            $result = true;
            foreach ($params['pedidos'] as $pedidoID )
            {
                $pedido = Pedido::findOne($pedidoID);
                if($pedido->usuario !== $user)
                {
                    $result = false;
                    break;
                }
            }
        }

//        var_dump($result);die;
        return $result;
    }
}