<?php

namespace app\controllers;

use yii\rest\ActiveController;



class VehiculoController extends ActiveController
{
    public static function allowedDomains()
    {
        return [
            // '*',                        // star allows all domains
            'http://localhost:3000',
            'http://test2.example.com',
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
    
            // For cross-domain AJAX request
            'corsFilter'  => [
                'class' => \yii\filters\Cors::className(),
                'cors'  => [
                    // restrict access to domains:
                    'Origin'                           => static::allowedDomains(),
                    'Access-Control-Request-Method'    => ['POST'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
                ],
            ],
    
        ]);
    }

    public $modelClass = 'app\models\Vehiculo';

}


?>
