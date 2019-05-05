<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_medicamento".
 *
 * @property int $id No.
 * @property string $nombre Nombre
 * @property string $descripcion Descripcion
 * @property int $activo Activo
 *
 * @property Medicamento[] $medicamentos
 */
class TipoMedicamento extends \yii\db\ActiveRecord
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
        return 'tipo_medicamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['activo'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'No.',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamentos()
    {
        return $this->hasMany(Medicamento::className(), ['tipo_id' => 'id']);
    }
}
