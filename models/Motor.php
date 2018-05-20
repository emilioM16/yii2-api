<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "motor".
 *
 * @property int $nro_serie
 * @property string $tipo
 * @property string $cilindrada
 *
 * @property Vehiculo[] $vehiculos
 */
class Motor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'motor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nro_serie', 'tipo', 'cilindrada'], 'required'],
            [['nro_serie'], 'integer'],
            [['tipo'], 'string', 'max' => 30],
            [['cilindrada'], 'string', 'max' => 20],
            [['nro_serie'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nro_serie' => 'Nro Serie',
            'tipo' => 'Tipo',
            'cilindrada' => 'Cilindrada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehiculos()
    {
        return $this->hasMany(Vehiculo::className(), ['nro_serie_motor' => 'nro_serie']);
    }
}
