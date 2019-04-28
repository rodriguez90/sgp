<?php

namespace app\models;
use Da\User\Model\User;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property int $id No.
 * @property string $codigo Código
 * @property int $estado Estado
 * @property string $observacion Observación
 * @property int $usuario_id Usuario
 * @property string $fecha_registro
 * @property string $fecha_entrega
 *
 * @property User $usuario
 * @property PedidoDetalle[] $pedidoDetalles
 */
class Pedido extends \yii\db\ActiveRecord
{
    const SOLICITADO = 1;
    const ACEPTADO = 2;
    const RECHAZADO = 3;
    const PENDIENTE = 4;
    const ENTREGADO = 4;

    const ESTADOS_CHOICES = [
        ['id' => 1, 'name' => 'Rural'],
        ['id' => 2, 'name' => 'Norte'],
        ['id' => 3, 'name' => 'Sur']
    ];

    const ESTADOS_LABEL = [
        1 => 'SOLICITADO',
        2 => 'ACEPTADO',
        3 => 'RECHAZADO',
        4 => 'PENDIENTE',
        5 => 'ENTREGADO'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'estado', 'usuario_id'], 'required'],
            [['estado', 'usuario_id'], 'integer'],
            [['observacion'], 'string'],
            [['fecha_registro', 'fecha_entrega'], 'safe'],
            [['codigo'], 'string', 'max' => 255],
            [['codigo'], 'unique'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'No.',
            'codigo' => 'Código',
            'estado' => 'Estado',
            'observacion' => 'Observación',
            'usuario_id' => 'Usuario',
            'fecha_registro' => 'Fecha Registro',
            'fecha_entrega' => 'Fecha Entrega',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoDetalles()
    {
        return $this->hasMany(PedidoDetalle::className(), ['pedido_id' => 'id']);
    }
}
