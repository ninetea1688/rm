<?php

namespace app\controllers;

use Yii;
use app\models\Prorisksubdetail;
use app\models\Proriskdetail;
use app\models\ProrisksubdetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;

use yii\helpers\ArrayHelper;
use yii\web\Session;
use yii\data\ActiveDataProvider;
use yii\behaviors\BlameableBehavior;
/**
 * ProrisksubdetailController implements the CRUD actions for Prorisksubdetail model.
 */
class ProrisksubdetailController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Prorisksubdetail models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProrisksubdetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Prorisksubdetail model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Prorisksubdetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Prorisksubdetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pro_risk_sub_detail_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Prorisksubdetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pro_risk_sub_detail_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Prorisksubdetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Prorisksubdetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prorisksubdetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Prorisksubdetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

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

    protected function GetProriskdetail($id) {
        $datas = Proriskdetail::find()->where(['pro_risk_id' => $id])->all();
        return $this->MapData($datas, 'pro_risk_detail_id', 'pro_risk_detail_name');
    }

    protected function GetProrisksubdetail($id) {
        $datas = Prorisksubdetail::find()->where(['pro_risk_detail_id' => $id])->all();
        return $this->MapData($datas, 'pro_risk_sub_detail_id', 'pro_risk_sub_detail_name');
    }

    protected function MapData($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }

}
