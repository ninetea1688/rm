<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\Session;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>

        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => '<i class="glyphicon glyphicon-exclamation-sign"></i><span> Risk Management</span>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $session = \yii::$app->session;
            echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'รายงานสรุป', 'url' => ['/site/im'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'รายงานความเสี่ยง', 'url' => ['/risk/info']],
            ['label' => 'รับเรื่องความเสี่ยง', 'url' => ['/risk/edit'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'ทบทวนความเสี่ยง', 'url' => ['risk/repeatlist']],
            //Admin Toll
            ['label' => 'ข้อมูลพื้นฐานของระบบ',
            'items' => [
            ['label' => 'รหัสหน่วยงาน', 'url' => ['/dep']],
            ['label' => 'ทีมคล่อมสายงาน', 'url' => ['/team']],
            ['label' => 'กลุ่มหน่วยงาน', 'url' => ['/group']],
            ['label' => 'ที่มาของข้อมูล', 'url' => ['/source']],
            ['label' => 'จัดการ User', 'url' => ['/user/admin/index']],
            //['label' => 'Email Notification setting', 'url' => ['/severity']],
            //['label' => 'setting', 'url' => ['/sys']],
            ], 'visible' => $session['level'] == 5]
            ,
            //end admin Tool
//report
            ['label' => 'ระบบรายงาน',
            'items' => [
            ['label' => 'จำนวนความเสี่ยงรายบุคล/บุคคลในหน่วยงาน', 'url' => ['/report/userreport']],
            ['label' => 'จำนวนความเสี่ยงรายบุคล/บุคคลในทีม', 'url' => ['/report/teamreport']],
            ['label' => 'สรุปจำนวนความเสี่ยงแยกตามหน่วยงาน', 'url' => ['/report/sumdep'], 'visible' => $session['level']>2],
            ['label' => 'สรุปจำนวนความเสี่ยงตามทีมคล่อมสายงาน', 'url' => ['/report/sumteam'], 'visible' => $session['level']>2],
            ['label' => 'รายงาน matrix ภาพรวม', 'url' => ['/report/matrixall'], 'visible' => $session['level']>=3],
            ['label' => 'รายงาน matrix หน่วยงาน', 'url' => ['/report/matrixdep']],
//                            ['label' => 'ทีมคล่อมสายงาน', 'url' => ['/team']],
//                            ['label' => 'กลุ่มหน่วยงาน', 'url' => ['/group']],
//                            ['label' => 'ที่มาของข้อมูล', 'url' => ['/source']],
//                            ['label' => 'จัดการ User', 'url' => ['/user/admin/index']],
            ], 'visible' => !Yii::$app->user->isGuest]
            ,
            //end report
            Yii::$app->user->isGuest ?
            ['label' => 'เข้าระบบ', 'url' => ['/user/security/login']] :
            ['label' => 'สวัสดีครับ ' . $session['fullname'] . '', 'items' => [
            ['label' => 'รายละเอียดผู้ใช้งาน', 'url' => ['/profile/update', 'id' => Yii::$app->user->identity->id]],
            ['label' => 'รายระเอียด User', 'url' => ['/user/settings/account']],
            ['label' => 'ออกจากระบบ', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
            ]],
            ['label' => 'ลงทะเบียน', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest],
            ['label' => 'ผู้พัฒนา', 'url' => ['site/about']],
            ],
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-right">&copy; นายสุรชัย ศรีอาราม  <?= date('Y') ?></p>

            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
