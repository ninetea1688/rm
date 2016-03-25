<?php

namespace app\controllers;
use Yii;
use yii\data\SqlDataProvider;
use yii\data\ActiveDataProvider;
use app\models\Risk;
use app\models\RiskSearch;
use app\models\Dep;
class ReportController extends \yii\web\Controller {
public $enableCsrfValidation = false;
    public function actionIndex() {
        $date1 = date("Y-m-d");
        $date2 = date("Y-m-d");
            if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
              $sql = "select * from risk where date_risk between '$date1' and '$date2'";
     $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
     $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
//            $dataProvider = new ActiveDataProvider([
//                'query' => Risk::find()->where('date_risk between "'.$date1.'" and "'. $date2.'"'),
//                'pagination' => ['pageSize' => 20,],
//            ]);
            $searchModel = new RiskSearch();

            return $this->render('index', [
                'date1' => $date1,
                'date2' => $date2,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider, ]);
        }
 else {
               
      $sql = "select * from risk where date_risk between '$date1' and '$date2'";
     $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
     $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
//     $dataProvider = new ActiveDataProvider([
//                'query' => Risk::find()->where('date_risk between "'.$date1.'" and "'. $date2.'"'),
//                'pagination' => ['pageSize' => 20,],
//            ]);
           $searchModel = new RiskSearch();

            return $this->render('index', [
                'date1' => date("Y-m-d"),
                'date2' => date("Y-m-d"),
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider, ]);
 }
            
 }
}
