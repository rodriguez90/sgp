<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "informacion_contacto".
 *
 * @property int $id Perfil
 * @property string $telefono Telefono
 * @property string $direccion Dirección
 * @property string $fecha_creacion
 *
 * @property Profile $id0
 */
class InformacionContacto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'informacion_contacto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telefono'], 'required'],
            [['fecha_creacion'], 'safe'],
            [['telefono', 'direccion'], 'string', 'max' => 255],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Perfil',
            'telefono' => 'Telefono',
            'direccion' => 'Dirección',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }
}
