<?php

namespace app\models;
use Da\User\Model\Profile;
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
 * @property double $stock Stock
 * @property int $proveedor_id Proveedor
 * @property int $tipo_id Tipo
 * @property string $fecha_registro
 * @property int $activo Activo
 * @property string $imagen Imagen
 *
 * @property User $proveedor
 * @property TipoMedicamento $tipo
 * @property PedidoDetalle[] $pedidoDetalles
 */
class Medicamento extends \yii\db\ActiveRecord
{

    const ESTADOS_LABEL = [
        1 => 'Activo',
        2 => 'Inactivo',
    ];

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
            [['proveedor_id', 'tipo_id', 'activo'], 'integer'],
            [['fecha_registro'], 'safe'],
            [['stock'], 'number'],
            [['codigo', 'nombre'], 'string', 'max' => 255],
            [['codigo'], 'unique'],
            [['imagen'], 'file', 'extensions' => 'png, jpg'],
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
            'indicacion' => 'Indicaciones',
            'contraindicacion' => 'Contraindicaciones',
            'observacion' => 'Observaciones',
            'stock' => 'Stock',
            'proveedor_id' => 'Proveedor',
            'tipo_id' => 'Tipo',
            'fecha_registro' => 'Fecha Registro',
            'activo' => 'Activo',
            'imagen' => 'Imagen'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(User::className(), ['id' => 'proveedor_id']);
    }

    private $_nombreProveedor = '';

    public function getNombreProveedor() {
        $this->_nombreProveedor = Profile::findOne(['user_id'=>$this->proveedor_id])->name;

        return $this->_nombreProveedor;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(TipoMedicamento::className(), ['id' => 'tipo_id']);
    }

    private $_nombreTipo = '';

    public function getNombreTipo() {
        $this->_nombreTipo = $this->tipo->nombre;

        return $this->_nombreTipo;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoDetalles()
    {
        return $this->hasMany(PedidoDetalle::className(), ['medicamento_id' => 'id']);
    }

    private $_cantidadPedidos;
    public function getCantidadPedidos() {

        $count = Pedido::find()
            ->innerJoin('pedido_detalle', 'pedido_detalle.pedido_id=pedido.id')
            ->innerJoin('medicamento', 'medicamento.id=pedido_detalle.medicamento_id')
            ->where(['pedido_detalle.medicamento_id'=>$this->id])
            ->count();

        return $count;
    }

    private $_total;
    public function getTotal() {

        $total = Pedido::find()
            ->innerJoin('pedido_detalle', 'pedido_detalle.pedido_id=pedido.id')
            ->innerJoin('medicamento', 'medicamento.id=pedido_detalle.medicamento_id')
            ->where(['pedido_detalle.medicamento_id'=>$this->id])
            ->sum('pedido_detalle.cantidad');

        $total = $total == null ? 0 : $total;

        return $total;
    }
}
