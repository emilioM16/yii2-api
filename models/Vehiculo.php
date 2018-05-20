<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehiculo".
 *
 * @property string $dominio
 * @property string $marca
 * @property string $modelo
 * @property string $tipo
 * @property int $nro_serie_motor
 * @property int $anio
 *
 * @property Motor $nroSerieMotor
 */
class Vehiculo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehiculo';
    }

    // public function fields()
    // {
    //     return [
    //         'id' => 'dominio',
    //         'marca' => 'marca',
    //         'modelo'=>'modelo',
    //         'tipo'=>'tipo',
    //         'anio'=>'anio',
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dominio', 'marca', 'modelo', 'tipo', 'nro_serie_motor', 'anio'], 'required'],
            [['nro_serie_motor', 'anio'], 'integer'],
            [['dominio'], 'string', 'max' => 9],
            [['marca', 'modelo', 'tipo'], 'string', 'max' => 30],
            [['dominio'], 'unique'],
            [['nro_serie_motor'], 'exist', 'skipOnError' => true, 'targetClass' => Motor::className(), 'targetAttribute' => ['nro_serie_motor' => 'nro_serie']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dominio' => 'Dominio',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'tipo' => 'Tipo',
            'nro_serie_motor' => 'Nro Serie Motor',
            'anio' => 'Anio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNroSerieMotor()
    {
        return $this->hasOne(Motor::className(), ['nro_serie' => 'nro_serie_motor']);
    }


}
