<?php


namespace app\controllers;

use Yii;
use app\models\Vehiculo;
use app\models\Motor;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\base\Exception;



class VehiculoController extends ActiveController
{


    public $modelClass = 'app\models\Vehiculo';


    public static function allowedDomains()
    {
        return [
            // '*',                        // star allows all domains
            'http://localhost:3000',
        ];
    }
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
    

        
        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                // restrict access to
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['POST', 'GET'],
                // Allow only POST and PUT methods
                'Access-Control-Request-Headers' => [' X-Requested-With', 'Origin', 'Content-Type','accept','Authorization'],
                // Allow only headers 'X-Wsse'
                // 'Access-Control-Allow-Credentials' => true,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 3600,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],
        ];
    
        return $behaviors;
    }



    public function actionCrear(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
 
        $vehiculo = new Vehiculo();
        $motor = new Motor();
        
        // $vehiculo->scenario = Vehiculo:: SCENARIO_CREATE;
   
        $vehiculo->attributes = \yii::$app->request->post();
        $motor->attributes = \yii::$app->request->post();
        $motor->nro_serie = \yii::$app->request->post('nro_serie_motor');
        try{
            $transaction = Yii::$app->db->beginTransaction();

            if($motor->save()){
                if($vehiculo->save()){
                    $transaction->commit();
                    return array('status' => true, 'data'=> 'vehiculo record is successfully updated');
                }else{
                    return array('status'=>false,'data'=>$vehiculo->attributes);    
                }  
            }
            else{
                return array('status'=>false,'data'=>$motor->attributes);    
            }
        }catch(Exception $e){
            $transaction->rollback();
            return $e;
        }
    }
    

}


?>
