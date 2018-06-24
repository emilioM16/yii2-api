<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehiculo".
 *
 * @property string $id
 * @property string $dominio
 * @property string $marca
 * @property string $modelo
 * @property string $tipo
 * @property string $version
 * @property int $nro_serie_motor
 * @property int $anio
 * @property string $valor
 *
 * @property Motor $nroSerieMotor
 */
class Vehiculo extends \yii\db\ActiveRecord
{

    public $datosMotor;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehiculo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dominio', 'marca', 'modelo', 'tipo', 'version', 'nro_serie_motor', 'anio', 'valor'], 'required'],
            [['nro_serie_motor', 'anio'], 'integer'],
            [['dominio'], 'string', 'max' => 9],
            [['marca', 'modelo', 'tipo'], 'string', 'max' => 30],
            [['version'], 'string', 'max' => 20],
            [['valor'], 'string', 'max' => 11],
            [['dominio'], 'unique'],
            [['nro_serie_motor'], 'unique'],
            [['nro_serie_motor'], 'exist', 'skipOnError' => true, 'targetClass' => Motor::className(), 'targetAttribute' => ['nro_serie_motor' => 'nro_serie']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dominio' => 'Dominio',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'tipo' => 'Tipo',
            'version' => 'Version',
            'nro_serie_motor' => 'Nro Serie Motor',
            'anio' => 'Anio',
            'valor' => 'Valor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNroSerieMotor()
    {
        return $this->hasOne(Motor::className(), ['nro_serie' => 'nro_serie_motor']);
    }

    

    public function extraFields() {
        return [
            'motor' => 'nroSerieMotor',
        ];
    }
}
