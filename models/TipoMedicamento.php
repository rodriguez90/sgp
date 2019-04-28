<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_medicamento".
 *
 * @property int $id No.
 * @property string $nombre Nombre
 * @property string $descripcion Descripcion
 *
 * @property Medicamento[] $medicamentos
 */
class TipoMedicamento extends \yii\db\ActiveRecord
{
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
