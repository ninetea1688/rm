<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Risk;

class SiteController extends Controller {

   public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','im', 'update','info', 'riskdep', 'riskteam'], //เฉพาะ action create,update
                'rules' => [
                    [
                        'allow' => true, //ยอมให้เข้าถึง
                        'roles' => ['@']//คนที่เข้าสู่ระบบ
                    ]
                ]
            ],
        ];
    }

    public function actionMail($fullname) {
        Yii::$app->mailer->compose('@app/mail/layouts/register', [
                    'fullname' => 'ผู้ดูแลระบบ'
                ])
                ->setFrom(['test@gmail.com' => 'Mr.Surachai Sriaram'])
                ->setTo('test@gmail.com')
                ->setSubject('ส่งเมลได้แล้ว')
                ->send();
    }

    public function actionChart() {
        return $this->render('chart');
    }


public function actionIndex() {

        return $this->render('index');
    }
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
 public function actionTest() {

     $c = Yii::$app->db->createCommand("SELECT count(*) as dep_id,date_risk FROM risk group by date_stamp ORDER BY date_stamp");
        $events = $c->queryAll();

        $task=[];
        foreach ($events as $eve) {
            $event = new \yii2fullcalendar\models\Event();
            $event->id = 1;
            $event->title = $eve['dep_id'].' รายการ';
            $event->start = $eve['date_risk'];
            $task[] = $event;

        }
        return $this->render('test',[
            'events'=>$task,
        ]);
    }

    public function actionIm() {
      $c = Yii::$app->db->createCommand("SELECT count(*) as dep_id,date_risk FROM risk group by date_stamp ORDER BY date_stamp");
        $events = $c->queryAll();
        $task=[];
        foreach ($events as $eve) {
            $event = new \yii2fullcalendar\models\Event();
            $event->id = 1;
            $event->title = $eve['dep_id'].' รายการ';
            $event->start = $eve['date_risk'];
            $task[] = $event;

        }
        return $this->render('im',[
            'events'=>$task,
        ]);
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->getUser()->logout();
        $session = \Yii::$app->session;
        $session->destroy();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

}
