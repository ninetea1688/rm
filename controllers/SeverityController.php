<?php

namespace app\controllers;

use Yii;
use app\models\Severity;
use app\models\SeveritySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;

/**
 * SeverityController implements the CRUD actions for Severity model.
 */
class SeverityController extends Controller
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
     * Lists all Severity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeveritySearch();
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

  
    protected function findModel($id)
    {
        if (($model = Severity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
