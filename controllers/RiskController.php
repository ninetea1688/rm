<?php

namespace app\controllers;

use Yii;
use yii\db;
use yii\data\SqlDataProvider;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Session;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\behaviors\BlameableBehavior;

use yii\data\ActiveDataProvider;

use app\models\Proriskdetail;
use app\models\Prorisksubdetail;
use app\models\Incident;
use app\models\Clinic;
use app\models\Severity;
use app\models\Risk;
use app\models\Prorisk;
use app\models\RiskSearch;
use app\models\Dep;
use app\models\Sys;
use app\models\Profile;

class RiskController extends Controller {

    public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'index', 'info', 'riskdep', 'riskteam'], //เฉพาะ action create,update
                'rules' => [
                    [
                        'allow' => true, //ยอมให้เข้าถึง
                        'roles' => ['@']//คนที่เข้าสู่ระบบ
                    ]
                ]
            ],
        ];
    }

    public function actionIndex() {
        $searchModel = new RiskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInfo() {
       return $this->render('info');
    }

      public function actionEdit() {
        return $this->render('edit');
    }
    public function actionRiskdep() {
        $session = Yii::$app->session;
        $uid = Yii::$app->user->identity->id;
        $gp = Profile::findOne(['user_id' => $uid]) ;
        $d = $gp->dep_id;        
        //$d = $session['dep'];
        $session['level'] = $gp->level_id;        
        if ($session['level'] == 1) {
            $dataProvider = new ActiveDataProvider([
                'query' => Risk::find()->where(['dep_id' => $d]),
                'pagination' => ['pageSize' => 20,],
            ]);
            $searchModel = new RiskSearch();

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            //$d = $session['dep'];
            $d = $gp->dep_id;
            $g = Dep::find()->select('group_id')->where(['dep_id' => $d]);
            $t = Dep::find()->select('dep_id')->where(['group_id' => $g]);
            $dataProvider = new ActiveDataProvider([
                'query' => Risk::find()->where(['in', 'dep_id', $t]),
                'pagination' => ['pageSize' => 20,],
            ]);
            $searchModel = new RiskSearch();

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionRiskteam() {
        $session = Yii::$app->session;
        $uid = Yii::$app->user->identity->id;
        $gp = Profile::findOne(['user_id' => $uid]) ;
        
        //$d = $session['team'];        
        $d = $gp->team_id;
        $dataProvider = new ActiveDataProvider([
            'query' => Risk::find()->where(['team_id' => $d]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $searchModel = new RiskSearch();

        return $this->render('indexteam', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionViewrepeat($id) {
        return $this->render('viewrepeat', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewreceive($id) {
        return $this->render('viewreceive', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Risk();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //echo "เพิ่มได้";
            //exit();
            return $this->redirect(['view', 'id' => $model->risk_id]);
        } else {
            //var_dump($model);
            //echo "เพิ่มไม่ได้";
            //exit();
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id) {
        $model = new Risk();        
        
        $model = $this->findModel($id);
        //$model->scenario = 'report';
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->risk_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionRepeatlist(){
        $searchModel = new RiskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('repeatlist',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReceivelist(){
        $searchModel = new RiskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('receivelist',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRepeat($id){
        $model = new Risk();
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewrepeat', 'id' => $model->risk_id]);
        } else {
            return $this->render('repeat', [
                'model' => $model,
            ]);
        }
    }

    public function actionReceive($id){
        $model = new Risk();
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewreceive', 'id' => $model->risk_id]);
        } else {
            return $this->render('receive', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Risk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

###casecad dropdown

    public function actionGetProriskdetail() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $pro_risk_id = $parents[0];
                $out = $this->getProriskdetail($pro_risk_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetProrisksubdetail() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $pro_risk_detail_id = $parents[0];
                $out = $this->getProrisksubdetail($pro_risk_detail_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetIncident(){
        $out = [];
        if (isset($_POST['depdrop_parents'])){
            $parents = $_POST['depdrop_parents'];
            if($parents != NULL) {
                $pro_risk_sub_detail_id = $parents[0];
                $out = $this->getIncident($pro_risk_sub_detail_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }
    
    
    public function actionGetSeverity() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $clinic_id = $parents[0];
                $out = $this->getSeverity($clinic_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    protected function GetProriskdetail($id) {
        $datas = Proriskdetail::find()->where(['pro_risk_id' => $id])->all();
        return $this->MapData($datas, 'pro_risk_detail_id', 'pro_risk_detail_name');
    }

    protected function GetProrisksubdetail($id) {
        $datas = Prorisksubdetail::find()->where(['pro_risk_detail_id' => $id])->all();
        return $this->MapData($datas, 'pro_risk_sub_detail_id', 'pro_risk_sub_detail_name');
    }

    protected function GetIncident($id) {
        $datas = Incident::find()->where(['pro_risk_sub_detail_id' => $id])->all();
        return $this->MapData($datas, 'incident_id', 'incident_name');
    }


    protected function GetSeverity($id) {
        $datas = Severity::find()->where(['clinic_id' => $id])->all();
        return $this->MapData($datas, 'severity_text', 'severity_name');
    }

    protected function MapData($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }

    #####casecad dropdown
}
