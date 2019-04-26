<?php

namespace app\models;
use Da\User\Model\User;

use Yii;

/**
 * This is the model class for table "medicamento".
 *
 * @property int $id No.
 * @property string $codigo Código
 * @property string $nombre Nombre
 * @property string $indicacion Indicación
 * @property string $contraindicacion Contraindicación
 * @property string $observacion Observación
 * @property int $stock Stock
 * @property int $proveedor_id Proveedor
 * @property int $tipo_id Tipo
 * @property string $fecha_registro
 *
 * @property User $proveedor
 * @property TipoMedicamento $tipo
 * @property PedidoDetalle[] $pedidoDetalles
 */
class Medicamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medicamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'indicacion', 'contraindicacion', 'stock', 'proveedor_id', 'tipo_id'], 'required'],
            [['indicacion', 'contraindicacion', 'observacion'], 'string'],
            [['stock', 'proveedor_id', 'tipo_id'], 'integer'],
            [['fecha_registro'], 'safe'],
            [['codigo', 'nombre'], 'string', 'max' => 255],
            [['codigo'], 'unique'],
            [['proveedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['proveedor_id' => 'id']],
            [['tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoMedicamento::className(), 'targetAttribute' => ['tipo_id' => 'id']],
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
            'nombre' => 'Nombre',
            'indicacion' => 'Indicación',
            'contraindicacion' => 'Contraindicación',
            'observacion' => 'Observación',
            'stock' => 'Stock',
            'proveedor_id' => 'Proveedor',
            'tipo_id' => 'Tipo',
            'fecha_registro' => 'Fecha Registro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(User::className(), ['id' => 'proveedor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(TipoMedicamento::className(), ['id' => 'tipo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoDetalles()
    {
        return $this->hasMany(PedidoDetalle::className(), ['medicamento_id' => 'id']);
    }
}
