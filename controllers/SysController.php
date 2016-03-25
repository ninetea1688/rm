<?php

namespace app\controllers;

use Yii;
use app\models\Sys;
use app\models\SysSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SysController implements the CRUD actions for Sys model.
 */
class SysController extends Controller
{
     public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['update', 'index'], //เฉพาะ action create,update
                'rules' => [
                    [
                        'allow' => true, //ยอมให้เข้าถึง
                        'roles' => ['@']//คนที่เข้าสู่ระบบ 
                    ]
                ]
            ],
        ];
    }


    /**
     * Lists all Sys models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SysSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

  
    /**
     * Finds the Sys model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sys the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sys::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
