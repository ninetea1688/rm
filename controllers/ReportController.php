<?php

namespace app\controllers;

use Yii;
use yii\data\SqlDataProvider;
use yii\data\ActiveDataProvider;
use app\models\Risk;
use app\models\RiskSearch;
use app\models\Dep;
use yii\filters\AccessControl;
use yii\behaviors\BlameableBehavior;
use yii\data\ArrayDataProvider;

class ReportController extends \yii\web\Controller
{

    public function behaviors()
    {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['sumdep', 'index', 'userreport'], //เฉพาะ action create,update
                'rules' => [
                    [
                        'allow' => true, //ยอมให้เข้าถึง
                        'roles' => ['@']//คนที่เข้าสู่ระบบ
                    ]
                ]
            ],
        ];
    }

    public $enableCsrfValidation = false;

    public function actionInfo()
    {
        return $this->render('info');
    }

    public function actionIndex()
    {
        $date1 = date("Y-m-d");
        $date2 = date("Y-m-d");
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
        }
        $sql = "select date_risk,
pr.pro_risk_name
,prd.pro_risk_detail_name
,prsd.pro_risk_sub_detail_name
,r.detail_prob
,dep.dep_name as dep_of_risk
,r.method
,f.follow_name
,p.name as name_report
,p2.name as name_edit
from risk r
LEFT OUTER JOIN pro_risk pr ON r.pro_risk_id=pr.pro_risk_id
LEFT OUTER JOIN pro_risk_detail prd ON r.pro_risk_detail_id=prd.pro_risk_detail_id
LEFT OUTER JOIN pro_risk_sub_detail prsd ON r.pro_risk_sub_detail_id=prsd.pro_risk_sub_detail_id
LEFT OUTER JOIN dep ON r.dep_id=dep.dep_id
LEFT OUTER JOIN profile p ON r.user_id=p.user_id
LEFT OUTER JOIN profile p2 ON r.edit_user_id=p2.user_id
LEFT OUTER JOIN follow f ON r.follow_id=f.follow_id where date_risk between '$date1' and '$date2'";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        $searchModel = new RiskSearch();

        return $this->render('index', [
            'date1' => $date1,
            'date2' => $date2,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,]);
    }

    public function actionSumdep()
    {
        $date1 = date("Y-m-d");
        $date2 = date("Y-m-d");
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
        }
        $sql = "SELECT d.dep_name,COUNT(r.risk_id) as n,SUM(CASE WHEN r.follow_id = 1 THEN 1 ELSE 0 END ) as fix,SUM(CASE WHEN r.follow_id <>1 THEN 1 ELSE 0 END ) as nofix
FROM risk r JOIN dep d on d.dep_id=r.dep_id where r.date_risk between '$date1' and '$date2' GROUP BY r.dep_id";
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        $searchModel = new RiskSearch();

        return $this->render('sumdep', [
            'date1' => $date1,
            'date2' => $date2,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,]);
    }

    public function actionSumteam()
    {
        $date1 = date("Y-m-d");
        $date2 = date("Y-m-d");
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
        }
        $sql = "SELECT t.team_name,COUNT(r.risk_id) as n,SUM(CASE WHEN r.follow_id = 1 THEN 1 ELSE 0 END ) as fix,SUM(CASE WHEN r.follow_id <>1 THEN 1 ELSE 0 END ) as nofix
FROM risk r JOIN team t ON r.team_id=t.team_id where r.date_risk between '$date1' and '$date2' GROUP BY r.team_id";
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        $searchModel = new RiskSearch();

        return $this->render('sumteam', [
            'date1' => $date1,
            'date2' => $date2,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,]);
    }

    public function actionMatrixlink($born, $score)
    {

        $sql = "SELECT m.code_color as color,m.color as cname,b.born_name,r.severity_level,
                  r.date_risk,pr.pro_risk_name,prd.pro_risk_detail_name,prsd.pro_risk_sub_detail_name,
                  r.detail_prob,dep.dep_name AS dep_of_risk,r.method,f.follow_name,p. NAME AS name_report,
                  p2. NAME AS name_edit,r.follow_id as follow_id FROM risk r
                  LEFT OUTER JOIN pro_risk pr ON r.pro_risk_id = pr.pro_risk_id
LEFT OUTER JOIN pro_risk_detail prd ON r.pro_risk_detail_id = prd.pro_risk_detail_id
LEFT OUTER JOIN pro_risk_sub_detail prsd ON r.pro_risk_sub_detail_id = prsd.pro_risk_sub_detail_id
LEFT OUTER JOIN dep ON r.dep_id = dep.dep_id
LEFT OUTER JOIN profile p ON r.user_id = p.user_id
LEFT OUTER JOIN profile p2 ON r.edit_user_id = p2.user_id
LEFT OUTER JOIN follow f ON r.follow_id = f.follow_id
LEFT OUTER JOIN born b on r.born_id=b.born_id
JOIN matrix m ON m.born_id = r.born_id and m.severity_level = r.severity_level
where r.born_id=$born AND m.score=$score ORDER BY m.score DESC";
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            //'pagination' => ['pageSize' => 5,],
        ]);
        $searchModel = new RiskSearch();

        return $this->render('matrixlink', [

            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,]);
    }

    public function actionMatrixall()
    {
        $date1 = date("Y-m-d");
        $date2 = date("Y-m-d");
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
        }
        $sql = "SELECT m.code_color as color,m.color as cname,b.born_name,r.severity_level,
                  r.date_risk,pr.pro_risk_name,prd.pro_risk_detail_name,prsd.pro_risk_sub_detail_name,
                  r.detail_prob,dep.dep_name AS dep_of_risk,r.method,f.follow_name,p. NAME AS name_report,
                  p2. NAME AS name_edit,r.follow_id as follow_id FROM risk r
                  LEFT OUTER JOIN pro_risk pr ON r.pro_risk_id = pr.pro_risk_id
LEFT OUTER JOIN pro_risk_detail prd ON r.pro_risk_detail_id = prd.pro_risk_detail_id
LEFT OUTER JOIN pro_risk_sub_detail prsd ON r.pro_risk_sub_detail_id = prsd.pro_risk_sub_detail_id
LEFT OUTER JOIN dep ON r.dep_id = dep.dep_id
LEFT OUTER JOIN profile p ON r.user_id = p.user_id
LEFT OUTER JOIN profile p2 ON r.edit_user_id = p2.user_id
LEFT OUTER JOIN follow f ON r.follow_id = f.follow_id
LEFT OUTER JOIN born b on r.born_id=b.born_id
JOIN matrix m ON m.born_id = r.born_id and m.severity_level = r.severity_level where r.date_risk between '$date1' and '$date2' ORDER BY m.score DESC";
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            //'pagination' => ['pageSize' => 5,],
        ]);
        $searchModel = new RiskSearch();

        return $this->render('matrixall', [
            'date1' => $date1,
            'date2' => $date2,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,]);
    }

    public function actionMatrixdep()
    {
        $date1 = date("Y-m-d");
        $date2 = date("Y-m-d");
        $dep = "";
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
            $dep = $request->post('dep');
        }
        $sql = "SELECT m.code_color as color,m.color as cname,b.born_name,r.severity_level,
                  r.date_risk,pr.pro_risk_name,prd.pro_risk_detail_name,prsd.pro_risk_sub_detail_name,
                  r.detail_prob,dep.dep_name AS dep_of_risk,r.method,f.follow_name,p. NAME AS name_report,
                  p2. NAME AS name_edit,r.follow_id as follow_id FROM risk r
                  LEFT OUTER JOIN pro_risk pr ON r.pro_risk_id = pr.pro_risk_id
LEFT OUTER JOIN pro_risk_detail prd ON r.pro_risk_detail_id = prd.pro_risk_detail_id
LEFT OUTER JOIN pro_risk_sub_detail prsd ON r.pro_risk_sub_detail_id = prsd.pro_risk_sub_detail_id
LEFT OUTER JOIN dep ON r.dep_id = dep.dep_id LEFT OUTER JOIN profile p ON r.user_id = p.user_id
LEFT OUTER JOIN profile p2 ON r.edit_user_id = p2.user_id LEFT OUTER JOIN follow f ON r.follow_id = f.follow_id
LEFT OUTER JOIN born b on r.born_id=b.born_id JOIN matrix m ON m.born_id = r.born_id and m.severity_level = r.severity_level
where r.date_risk between '$date1' and '$date2'  ORDER BY m.score DESC";
        if ($dep != '') {
            $sql = "SELECT m.code_color as color,m.color as cname,b.born_name,r.severity_level,
                  r.date_risk,pr.pro_risk_name,prd.pro_risk_detail_name,prsd.pro_risk_sub_detail_name,
                  r.detail_prob,dep.dep_name AS dep_of_risk,r.method,f.follow_name,p. NAME AS name_report,
                  p2. NAME AS name_edit,r.follow_id as follow_id FROM risk r
                  LEFT OUTER JOIN pro_risk pr ON r.pro_risk_id = pr.pro_risk_id
LEFT OUTER JOIN pro_risk_detail prd ON r.pro_risk_detail_id = prd.pro_risk_detail_id
LEFT OUTER JOIN pro_risk_sub_detail prsd ON r.pro_risk_sub_detail_id = prsd.pro_risk_sub_detail_id
LEFT OUTER JOIN dep ON r.dep_id = dep.dep_id LEFT OUTER JOIN profile p ON r.user_id = p.user_id
LEFT OUTER JOIN profile p2 ON r.edit_user_id = p2.user_id LEFT OUTER JOIN follow f ON r.follow_id = f.follow_id
LEFT OUTER JOIN born b on r.born_id=b.born_id JOIN matrix m ON m.born_id = r.born_id and m.severity_level = r.severity_level
where r.date_risk between '$date1' and '$date2' and r.dep_id=$dep ORDER BY m.score DESC";
        }
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            //'pagination' => ['pageSize' => 5,],
        ]);
        $searchModel = new RiskSearch();

        return $this->render('matrixdep', [
            'date1' => $date1,
            'date2' => $date2,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dep' => $dep,
        ]);
    }

    /////////////////////////////////////////////////
    public function actionUserreport()
    {
        $date1 = date("Y-m-d");
        $date2 = date("Y-m-d");
        $user = "";
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
            $user = $request->post('user');
        }
        $sql = "SELECT m.code_color as color,m.color as cname,b.born_name,r.severity_level,
                  r.date_risk,pr.pro_risk_name,prd.pro_risk_detail_name,prsd.pro_risk_sub_detail_name,
                  r.detail_prob,dep.dep_name AS dep_of_risk,r.method,f.follow_name,p. NAME AS name_report,
                  p2. NAME AS name_edit,r.follow_id as follow_id FROM risk r
                  LEFT OUTER JOIN pro_risk pr ON r.pro_risk_id = pr.pro_risk_id
LEFT OUTER JOIN pro_risk_detail prd ON r.pro_risk_detail_id = prd.pro_risk_detail_id
LEFT OUTER JOIN pro_risk_sub_detail prsd ON r.pro_risk_sub_detail_id = prsd.pro_risk_sub_detail_id
LEFT OUTER JOIN dep ON r.dep_id = dep.dep_id LEFT OUTER JOIN profile p ON r.user_id = p.user_id
LEFT OUTER JOIN profile p2 ON r.edit_user_id = p2.user_id LEFT OUTER JOIN follow f ON r.follow_id = f.follow_id
LEFT OUTER JOIN born b on r.born_id=b.born_id JOIN matrix m ON m.born_id = r.born_id and m.severity_level = r.severity_level
where r.date_risk between '$date1' and '$date2' and r.user_id = '$user' ORDER BY m.score DESC";
        if ($user != '') {
            $sql = "SELECT m.code_color as color,m.color as cname,b.born_name,r.severity_level,
                  r.date_risk,pr.pro_risk_name,prd.pro_risk_detail_name,prsd.pro_risk_sub_detail_name,
                  r.detail_prob,dep.dep_name AS dep_of_risk,r.method,f.follow_name,p. NAME AS name_report,
                  p2. NAME AS name_edit,r.follow_id as follow_id FROM risk r
                  LEFT OUTER JOIN pro_risk pr ON r.pro_risk_id = pr.pro_risk_id
LEFT OUTER JOIN pro_risk_detail prd ON r.pro_risk_detail_id = prd.pro_risk_detail_id
LEFT OUTER JOIN pro_risk_sub_detail prsd ON r.pro_risk_sub_detail_id = prsd.pro_risk_sub_detail_id
LEFT OUTER JOIN dep ON r.dep_id = dep.dep_id LEFT OUTER JOIN profile p ON r.user_id = p.user_id
LEFT OUTER JOIN profile p2 ON r.edit_user_id = p2.user_id LEFT OUTER JOIN follow f ON r.follow_id = f.follow_id
LEFT OUTER JOIN born b on r.born_id=b.born_id JOIN matrix m ON m.born_id = r.born_id and m.severity_level = r.severity_level
where r.date_risk between '$date1' and '$date2' and r.user_id = '$user'  ORDER BY m.score DESC";
        }
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            //'pagination' => ['pageSize' => 5,],
        ]);

        $searchModel = new RiskSearch();

        return $this->render('userreport', [
            'date1' => $date1,
            'date2' => $date2,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'user' => $user
        ]);
    }

    ///////////////////////////////////////////

    public function actionTeamreport()
    {
        $date1 = date("Y-m-d");
        $date2 = date("Y-m-d");
        $user = "";
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
            $user = $request->post('user');
        }
        $sql = "SELECT m.code_color as color,m.color as cname,b.born_name,r.severity_level,
                  r.date_risk,pr.pro_risk_name,prd.pro_risk_detail_name,prsd.pro_risk_sub_detail_name,
                  r.detail_prob,dep.dep_name AS dep_of_risk,r.method,f.follow_name,p. NAME AS name_report,
                  p2. NAME AS name_edit,r.follow_id as follow_id FROM risk r
                  LEFT OUTER JOIN pro_risk pr ON r.pro_risk_id = pr.pro_risk_id
LEFT OUTER JOIN pro_risk_detail prd ON r.pro_risk_detail_id = prd.pro_risk_detail_id
LEFT OUTER JOIN pro_risk_sub_detail prsd ON r.pro_risk_sub_detail_id = prsd.pro_risk_sub_detail_id
LEFT OUTER JOIN dep ON r.dep_id = dep.dep_id LEFT OUTER JOIN profile p ON r.user_id = p.user_id
LEFT OUTER JOIN profile p2 ON r.edit_user_id = p2.user_id LEFT OUTER JOIN follow f ON r.follow_id = f.follow_id
LEFT OUTER JOIN born b on r.born_id=b.born_id JOIN matrix m ON m.born_id = r.born_id and m.severity_level = r.severity_level
where r.date_risk between '$date1' and '$date2' and r.user_id = '$user' ORDER BY m.score DESC";
        if ($user != '') {
            $sql = "SELECT m.code_color as color,m.color as cname,b.born_name,r.severity_level,
                  r.date_risk,pr.pro_risk_name,prd.pro_risk_detail_name,prsd.pro_risk_sub_detail_name,
                  r.detail_prob,dep.dep_name AS dep_of_risk,r.method,f.follow_name,p. NAME AS name_report,
                  p2. NAME AS name_edit,r.follow_id as follow_id FROM risk r
                  LEFT OUTER JOIN pro_risk pr ON r.pro_risk_id = pr.pro_risk_id
LEFT OUTER JOIN pro_risk_detail prd ON r.pro_risk_detail_id = prd.pro_risk_detail_id
LEFT OUTER JOIN pro_risk_sub_detail prsd ON r.pro_risk_sub_detail_id = prsd.pro_risk_sub_detail_id
LEFT OUTER JOIN dep ON r.dep_id = dep.dep_id LEFT OUTER JOIN profile p ON r.user_id = p.user_id
LEFT OUTER JOIN profile p2 ON r.edit_user_id = p2.user_id LEFT OUTER JOIN follow f ON r.follow_id = f.follow_id
LEFT OUTER JOIN born b on r.born_id=b.born_id JOIN matrix m ON m.born_id = r.born_id and m.severity_level = r.severity_level
where r.date_risk between '$date1' and '$date2' and r.user_id = '$user'  ORDER BY m.score DESC";
        }
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            //'pagination' => ['pageSize' => 5,],
        ]);

        $searchModel = new RiskSearch();

        return $this->render('teamreport', [
            'date1' => $date1,
            'date2' => $date2,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'user' => $user
        ]);
    }

    ///////////////////////////////////////////

    public function actionMissandnearreport()
    {
        $sql = "select
  sum(countab) as nearmiss,
  sum(countci) as miss
  FROM
  (select
  if(severity_level BETWEEN 'A' and 'B',1,0) as countab,
  if(severity_level BETWEEN 'C' and 'I',1,0) as countci
from risk) as allrisk";

    $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
           'allModels' => $rawData,
        ]);

        //เตรียมข้อมูลผู้ป่วยนอกส่งให้กราฟ
        for ($i = 0; $i < sizeof($rawData); $i++) {
            $nearmiss[] = (int) $rawData[$i]['nearmiss'];
            $miss[] = (int) $rawData[$i]['miss'];
        }

        return $this->render('missandnearreport',[
            'dataProvider' => $dataProvider,
            'nearmiss' => $nearmiss,
            'miss' => $miss,
        ]);
    }

    public function actionIncidentaireport()
    {
        $sql = "select l_level.severity_level,count(risk.severity_level) as numx
from l_level LEFT outer JOIN risk on  risk.severity_level = l_level.severity_level
GROUP BY l_level.severity_level";
        $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
           'allModels' => $rawData,
        ]);

        for ($i = 0; $i < sizeof($rawData); $i++) {
            $severity_level[] = $rawData[$i]['severity_level'];
            $numx[] = (int) $rawData[$i]['numx'];
        }



        return $this->render('incidentaireport',[
            'dataProvider' => $dataProvider,
            'severity_level' => $severity_level,
            'numx' => $numx,
        ]);
    }

    public function actionSmlreport(){
        $sql = "select
  sum(countac) as small,
  sum(countdf) as medium,
  sum(countgi) as hiegth
  FROM
  (select
  if(severity_level BETWEEN 'A' and 'C',1,0) as countac,
  if(severity_level BETWEEN 'D' and 'F',1,0) as countdf,
  if(severity_level BETWEEN 'G' and 'I',1,0) as countgi
from risk) as allrisk";

        $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rawData,
        ]);

        for ($i = 0; $i < sizeof($rawData); $i++) {
            $small[] = (int) $rawData[$i]['small'];
            $medium[] = (int) $rawData[$i]['medium'];
            $hiegth[] = (int) $rawData[$i] ['hiegth'];
        }

        return $this->render('smlreport',[
            'dataProvider' => $dataProvider,
            'small' => $small,
            'medium' => $medium,
            'hiegth' => $hiegth
        ]);
    }


    public function actionProgramseverityreport(){

        $sql = "select pro_risk_id,pro_risk_name,
  sum(cA) as allA,
  sum(CB) as allB,
  sum(cC) as allC,
  sum(cD) as allD,
  sum(cE) as allE,
  sum(cF) as allF,
  sum(cG) as allG,
  sum(cH) as allH,
  sum(cI) as allI
  FROM
(select
  pro_risk.pro_risk_id,pro_risk.pro_risk_name,
  if(risk.severity_level = 'A',1,0) as cA,
  if(risk.severity_level = 'B',1,0) as cB,
  if(risk.severity_level = 'C',1,0) as cC,
  if(risk.severity_level = 'D',1,0) as cD,
  if(risk.severity_level = 'E',1,0) as cE,
  if(risk.severity_level = 'F',1,0) as cF,
  if(risk.severity_level = 'G',1,0) as cG,
  if(risk.severity_level = 'H',1,0) as cH,
  if(risk.severity_level = 'I',1,0) as cI
from pro_risk left OUTER JOIN risk on pro_risk.pro_risk_id = risk.pro_risk_id
order by pro_risk.pro_risk_id) as allrisk
GROUP BY pro_risk_name";

        $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rawData,
        ]);

        for ($i = 0; $i < sizeof($rawData); $i++) {
            $pro_risk_id[] = $rawData[$i]['pro_risk_id'];
            $pro_risk_name[] = $rawData[$i]['pro_risk_name'];
            $allA[] = (int) $rawData[$i]['allA'];
            $allB[] = (int) $rawData[$i]['allB'];
            $allC[] = (int) $rawData[$i] ['allC'];
            $allD[] = (int) $rawData[$i] ['allD'];
            $allE[] = (int) $rawData[$i] ['allE'];
            $allF[] = (int) $rawData[$i] ['allF'];
            $allG[] = (int) $rawData[$i] ['allG'];
            $allH[] = (int) $rawData[$i] ['allH'];
            $allI[] = (int) $rawData[$i] ['allI'];
        }

        return $this->render('programseverityreport',[
            'dataProvider' => $dataProvider,
            'pro_risk_id' => $pro_risk_id,
            'pro_risk_name' => $pro_risk_name,
            'allA' => $allA,
            'allB' => $allB,
            'allC' => $allC,
            'allD' => $allD,
            'allE' => $allE,
            'allF' => $allF,
            'allG' => $allG,
            'allH' => $allH,
            'allI' => $allI

        ]);
    }

    //drill down โปรแกรมความย่อย
    public function actionSubprogramseveritylevel1($pro_risk_id){
        $sql = "select pro_risk_detail_id,pro_risk_detail_name,
  sum(cA) as allA,
  sum(CB) as allB,
  sum(cC) as allC,
  sum(cD) as allD,
  sum(cE) as allE,
  sum(cF) as allF,
  sum(cG) as allG,
  sum(cH) as allH,
  sum(cI) as allI
  FROM
(select
pro_risk_detail.pro_risk_detail_id,
  pro_risk_detail.pro_risk_detail_name,
  if(risk.severity_level = 'A',1,0) as cA,
  if(risk.severity_level = 'B',1,0) as cB,
  if(risk.severity_level = 'C',1,0) as cC,
  if(risk.severity_level = 'D',1,0) as cD,
  if(risk.severity_level = 'E',1,0) as cE,
  if(risk.severity_level = 'F',1,0) as cF,
  if(risk.severity_level = 'G',1,0) as cG,
  if(risk.severity_level = 'H',1,0) as cH,
  if(risk.severity_level = 'I',1,0) as cI
from  pro_risk_detail LEFT OUTER JOIN risk on risk.pro_risk_id = pro_risk_detail.pro_risk_id and risk.pro_risk_detail_id = pro_risk_detail.pro_risk_detail_id
WHERE pro_risk_detail.pro_risk_id = '$pro_risk_id'
 order by pro_risk_detail.pro_risk_detail_id) as allrisk
GROUP BY pro_risk_detail_name";

    $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rawData,
        ]);


        for ($i = 0; $i < sizeof($rawData); $i++) {
            $pro_risk_detail_id[] = $rawData[$i]['pro_risk_detail_id'];
            $pro_risk_detail_name[] = $rawData[$i]['pro_risk_detail_name'];
            $allA[] = (int) $rawData[$i]['allA'];
            $allB[] = (int) $rawData[$i]['allB'];
            $allC[] = (int) $rawData[$i] ['allC'];
            $allD[] = (int) $rawData[$i] ['allD'];
            $allE[] = (int) $rawData[$i] ['allE'];
            $allF[] = (int) $rawData[$i] ['allF'];
            $allG[] = (int) $rawData[$i] ['allG'];
            $allH[] = (int) $rawData[$i] ['allH'];
            $allI[] = (int) $rawData[$i] ['allI'];
        }


        return $this->render('subprogramseveritylevel1',[
            'dataProvider' => $dataProvider,
            'pro_risk_detail_id' => $pro_risk_detail_id,
            'pro_risk_detail_name' => $pro_risk_detail_name,
            'allA' => $allA,
            'allB' => $allB,
            'allC' => $allC,
            'allD' => $allD,
            'allE' => $allE,
            'allF' => $allF,
            'allG' => $allG,
            'allH' => $allH,
            'allI' => $allI
        ]);

    }

    //drill down กระบวนการ
    public function actionSubprogramseveritylevel2($pro_risk_detail_id){
        $sql = "select pro_risk_sub_detail_id,pro_risk_sub_detail_name,
  sum(cA) as allA,
  sum(CB) as allB,
  sum(cC) as allC,
  sum(cD) as allD,
  sum(cE) as allE,
  sum(cF) as allF,
  sum(cG) as allG,
  sum(cH) as allH,
  sum(cI) as allI
  FROM
(select
  pro_risk_sub_detail.pro_risk_sub_detail_id,pro_risk_sub_detail.pro_risk_sub_detail_name,
  if(risk.severity_level = 'A',1,0) as cA,
  if(risk.severity_level = 'B',1,0) as cB,
  if(risk.severity_level = 'C',1,0) as cC,
  if(risk.severity_level = 'D',1,0) as cD,
  if(risk.severity_level = 'E',1,0) as cE,
  if(risk.severity_level = 'F',1,0) as cF,
  if(risk.severity_level = 'G',1,0) as cG,
  if(risk.severity_level = 'H',1,0) as cH,
  if(risk.severity_level = 'I',1,0) as cI
from  pro_risk_sub_detail LEFT OUTER JOIN risk on
risk.pro_risk_id = pro_risk_sub_detail.pro_risk_id
and
risk.pro_risk_detail_id = pro_risk_sub_detail.pro_risk_detail_id
AND
risk.pro_risk_sub_detail_id = pro_risk_sub_detail.pro_risk_sub_detail_id
WHERE pro_risk_sub_detail.pro_risk_detail_id = '$pro_risk_detail_id'
 order by pro_risk_sub_detail.pro_risk_sub_detail_id) as allrisk
GROUP BY pro_risk_sub_detail_name";

    $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rawData,
        ]);


        for ($i = 0; $i < sizeof($rawData); $i++) {
            $pro_risk_sub_detail_id[] = $rawData[$i]['pro_risk_sub_detail_id'];
            $pro_risk_sub_detail_name[] = $rawData[$i]['pro_risk_sub_detail_name'];
            $allA[] = (int) $rawData[$i]['allA'];
            $allB[] = (int) $rawData[$i]['allB'];
            $allC[] = (int) $rawData[$i] ['allC'];
            $allD[] = (int) $rawData[$i] ['allD'];
            $allE[] = (int) $rawData[$i] ['allE'];
            $allF[] = (int) $rawData[$i] ['allF'];
            $allG[] = (int) $rawData[$i] ['allG'];
            $allH[] = (int) $rawData[$i] ['allH'];
            $allI[] = (int) $rawData[$i] ['allI'];
        }


        return $this->render('subprogramseveritylevel2',[
            'dataProvider' => $dataProvider,
            'pro_risk_sub_detail_id' => $pro_risk_detail_id,
            'pro_risk_sub_detail_name' => $pro_risk_sub_detail_name,
            'allA' => $allA,
            'allB' => $allB,
            'allC' => $allC,
            'allD' => $allD,
            'allE' => $allE,
            'allF' => $allF,
            'allG' => $allG,
            'allH' => $allH,
            'allI' => $allI
        ]);


    }

    //drill down อุบัติการณ์
    public function actionSubprogramseveritylevel3($pro_risk_sub_detail_id){
        $sql = "select incident_id,incident_name,
  sum(cA) as allA,
  sum(CB) as allB,
  sum(cC) as allC,
  sum(cD) as allD,
  sum(cE) as allE,
  sum(cF) as allF,
  sum(cG) as allG,
  sum(cH) as allH,
  sum(cI) as allI
  FROM
(select
  incident.incident_id,incident.incident_name,
  if(risk.severity_level = 'A',1,0) as cA,
  if(risk.severity_level = 'B',1,0) as cB,
  if(risk.severity_level = 'C',1,0) as cC,
  if(risk.severity_level = 'D',1,0) as cD,
  if(risk.severity_level = 'E',1,0) as cE,
  if(risk.severity_level = 'F',1,0) as cF,
  if(risk.severity_level = 'G',1,0) as cG,
  if(risk.severity_level = 'H',1,0) as cH,
  if(risk.severity_level = 'I',1,0) as cI
from  incident LEFT OUTER JOIN risk on  risk.pro_risk_id = incident.pro_risk_id and risk.pro_risk_detail_id = incident.pro_risk_detail_id
and risk.pro_risk_sub_detail_id = incident.pro_risk_sub_detail_id and risk.incident_id = incident.incident_id
WHERE incident.pro_risk_sub_detail_id = '$pro_risk_sub_detail_id'
 order by incident.incident_id) as allrisk
GROUP BY incident_name ORDER BY incident_id;";

        $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rawData,
        ]);


        for ($i = 0; $i < sizeof($rawData); $i++) {
            $incident_id[] = $rawData[$i]['incident_id'];
            $incident_name[] = $rawData[$i]['incident_name'];
            $allA[] = (int) $rawData[$i]['allA'];
            $allB[] = (int) $rawData[$i]['allB'];
            $allC[] = (int) $rawData[$i] ['allC'];
            $allD[] = (int) $rawData[$i] ['allD'];
            $allE[] = (int) $rawData[$i] ['allE'];
            $allF[] = (int) $rawData[$i] ['allF'];
            $allG[] = (int) $rawData[$i] ['allG'];
            $allH[] = (int) $rawData[$i] ['allH'];
            $allI[] = (int) $rawData[$i] ['allI'];
        }


        return $this->render('subprogramseveritylevel3',[
            'dataProvider' => $dataProvider,
            'incident_id' => $incident_id,
            'incident_name' => $incident_name,
            'allA' => $allA,
            'allB' => $allB,
            'allC' => $allC,
            'allD' => $allD,
            'allE' => $allE,
            'allF' => $allF,
            'allG' => $allG,
            'allH' => $allH,
            'allI' => $allI
        ]);

    }

    public function actionAllclinicreport(){

        $sql = "select clinic.clinic_name,count(risk.clinic_id) as numx
from clinic left outer join risk on risk.clinic_id = clinic.clinic_id
GROUP BY clinic.clinic_id";


        $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
           'allModels' => $rawData,
        ]);

        for ($i = 0; $i < sizeof($rawData); $i++) {
            $clinic_name[] = $rawData[$i]['clinic_name'];
            $numx[] = (int) $rawData[$i]['numx'];

        }

        return $this->render('allclinicreport',[
            'dataProvider' => $dataProvider,
            'clinic_name' => $clinic_name,
            'numx' => $numx,
        ]);
    }

    public function actionClinicnonereport(){

        $sql = "select
  sum(if(risk.clinic_id BETWEEN 1 and 2,1,0)) as clinic,
  sum(if(risk.clinic_id = 3,1,0)) as noneclinic
from clinic left outer join risk on risk.clinic_id = clinic.clinic_id";


        $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rawData,
        ]);

        for ($i = 0; $i < sizeof($rawData); $i++) {
            $clinic[] = (int) $rawData[$i]['clinic'];
            $noneclinic[] = (int) $rawData[$i]['noneclinic'];

        }


        return $this->render('clinicnonereport',[
            'dataProvider' => $dataProvider,
            'clinic' => $clinic,
            'noneclinic' => $noneclinic,
        ]);
    }


    public function actionTopincidentreport(){

        return $this->render('topincidentreport');
    }

    public function actionPsgreport(){
        $sql = "select psg.psg_id,psg.psgname,numx from
(select psgprogram.psg_id,count(psgprogram.psg_id) as numx
FROM psgprogram inner join risk on psgprogram.pro_risk_id = risk.pro_risk_id
                   and psgprogram.pro_risk_detail_id = risk.pro_risk_detail_id
                   and psgprogram.pro_risk_sub_detail_id = risk.pro_risk_sub_detail_id
                   and psgprogram.incident_id = risk.incident_id GROUP BY psgprogram.psg_id) as allpsg
  RIGHT OUTER JOIN psg on allpsg.psg_id = psg.psg_id GROUP BY psg.psg_id";


        $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rawData,
        ]);

        for ($i = 0; $i < sizeof($rawData); $i++) {
            $psgname[] = $rawData[$i]['psgname'];
            $numx[] = (int) $rawData[$i]['numx'];

        }

        return $this->render('psgreport',[
            'dataProvider' => $dataProvider,
            'psgname' => $psgname,
            'numx' => $numx,
        ]);
    }

}
