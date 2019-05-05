<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido_detalle".
 *
 * @property int $id No.
 * @property int $cantidad Cantidad
 * @property int $pedido_id Pedido
 * @property int $medicamento_id Medicamento
 *
 * @property Medicamento $medicamento
 * @property Pedido $pedido
 */
class PedidoDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cantidad', 'pedido_id', 'medicamento_id'], 'required'],
            [['cantidad', 'pedido_id', 'medicamento_id'], 'integer'],
            [['medicamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicamento::className(), 'targetAttribute' => ['medicamento_id' => 'id']],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['pedido_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'No.',
            'cantidad' => 'Cantidad',
            'pedido_id' => 'Pedido',
            'medicamento_id' => 'Medicamento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamento()
    {
        return $this->hasOne(Medicamento::className(), ['id' => 'medicamento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedido::className(), ['id' => 'pedido_id']);
    }
}
