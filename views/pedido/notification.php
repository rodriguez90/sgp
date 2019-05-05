<?php
/**
 * Created by PhpStorm.
 * User: yopt
 * Date: 26/06/2018
 * Time: 01:28 PM
 */
use app\models\Pedido;
use app\models\Medicamento;
use app\models\PedidoDetalle;
use Da\User\Model\User;
use Da\User\Model\Profile;
use yii\helpers\Url;

?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <style type="text/css">

        table {
            font-family: "Helvetica", "Arial", sans-serif;
            font-size: 12px;
            margin-top: 0px;
            width: 100%;
        }

        .info {
            padding: 10px 0px 10px 20px;
        }

        td.btn, td.button {
            vertical-align: middle;
            padding: 5px 0px 5px 0px;
            background: rgb(0, 172, 172) none repeat scroll 0% 0%;
            border-color: rgb(0, 172, 172);
        }

        .btn a, .button a {
            color: rgb(255, 255, 255);
            font-weight: bold;
            text-decoration: none;
            font-family: "Helvetica", "Arial", "sans-serif";
            font-size: 12px;

        }

        #datalle td {
            padding: 10px 10px 10px 10px;
            width: 33.333333%;
            border: 1px solid #DDD;
        }

        .title {
            font-weight: bold;
        }

        #logo {
            position: relative;
            float: left;

        }

        #fecha {
            position: relative;
            float: right;
        }

        #pdfhead td {
            padding: 10px 10px 10px 10px;
            width: 33.333333333333%;
        }

        #links td {
            padding: 10px 10px 10px 10px;
            width: 20%;
        }

    </style>
</head>
<body>

<div class="row">


    <table id="pdfhead" width="100%">
        <tr>
            <td>
                <div id="logo">
                    <img src="<?php echo Yii::$app->homeUrl; ?>/../img/logo.png">
                </div>
            </td>
            <td style="text-align: center"><h4 >NOTIFICACION DE NUEVO PEDIDO</h4> </td>
            <td style="text-align: right"><div id="fecha">
                    <label> <?php echo date('d/m/Y');?></label>
                </div>
            </td>
        </tr>
    </table>

    <h5 style="text-align: center">Medicamentos</h5>

    <table id="links" width="100%">

        <tbody>

        <tr style="text-align: center">
            <td></td>
            <td></td>
            <td class="btn">
                <a href="<?php echo Url::to(['/pedido/view', 'id' => $model->id], true); ?>">Ver Pedido </a>
            </td>
            <td></td>
            <td></td>
        </tr>

        </tbody>
    </table>


    <table id="contenedores" width="100%" style="text-align: center">

        <thead>
           <tr>
               <th>Medicamento</th>
               <th>Código</th>
               <th>Cantidad</th>
           </tr>
        </thead>
        <tbody>

        <?php

        while (count($medicamentos) > 0 ){
            echo "<tr>";
            $medicamento = array_shift($medicamentos);
            echo " <td>" . $medicamento['nombre']  . "</td>";
            echo " <td>" . $medicamento['codigo']  . "</td>";
            echo " <td>" . $medicamento['cantidad']  . "</td>";
            echo "</tr>";
        }
        ?>

        </tbody>
    </table>
</div>
</body>
</html>