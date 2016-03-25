<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\Session;

$session = \yii::$app->session;
?>
<aside class="main-sidebar">

    <section class="sidebar">


        <?=
        Nav::widget(
                [
                    'encodeLabels' => false,
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => '<i class="fa fa-home "></i><span>Home</span>', 'url' => ['/site/index']],
                        ['label' => '<i class="fa fa-bar-chart"></i><span>รายงานสรุป</span>', 'url' => ['/site/im'], 'visible' => !Yii::$app->user->isGuest],
                        ['label' => '<i class="fa fa-pencil-square"></i><span>รายงานความเสี่ยง</span>', 'url' => ['/risk/info']],
                        ['label' => '<i class="fa fa-pencil-square-o"></i><span >แก้ไขความเสี่ยง</span>', 'url' => ['/risk/edit'],],
                        ['label' => '<i class="fa fa-navicon"></i><span >ทบทวนความเสี่ยง</span>', 'url' => ['/risk/repeatlist'],],
                        ['label' => '<i class="fa fa-sticky-note-o"></i><span >ศูนย์รับเรื่องทบทวน</span>', 'url' => ['/risk/receivelist'],],
                        ['label' => '<i class="fa fa-clipboard "></i><span>ระบบรายงาน</span>',
                            'items' => [
                                ['label' => 'จำนวนความเสี่ยงรายบุคล/บุคคลในหน่วยงาน', 'url' => ['/report/userreport']],
                                ['label' => 'จำนวนความเสี่ยงรายบุคล/บุคคลในทีม', 'url' => ['/report/teamreport']],
                                ['label' => 'สรุปจำนวนความเสี่ยงแยกตามหน่วยงาน', 'url' => ['/report/sumdep'], 'visible' => $session['level'] > 2],
                                ['label' => 'สรุปจำนวนความเสี่ยงตามทีมคล่อมสายงาน', 'url' => ['/report/sumteam'], 'visible' => $session['level'] > 2],
                                ['label' => 'รายงาน matrix ภาพรวม', 'url' => ['/report/matrixall'], 'visible' => $session['level'] >= 3],
                                ['label' => 'รายงาน matrix หน่วยงาน', 'url' => ['/report/matrixdep']],
                                ['label' => 'รายงานอุบัติการ Miss and Near Miss', 'url' => ['/report/missandnearreport']],
                                ['label' => 'รายงานอุบัติการแยกระดับความรุนแรง', 'url' => ['/report/incidentaireport']],
                                ['label' => 'รายงานอุบัติการแยกระดับความรุนแรง น้อย ปานกลาง มาก', 'url' => ['/report/smlreport']],
                                ['label' => 'รายงานอุบัติการ แยกตามโปรแกรมความเสี่ยง แยกระดับความรุนแรง', 'url' => ['/report/programseverityreport']],
                                ['label' => 'รายงานอุบัติการแยกตามคลินิค', 'url' => ['/report/allclinicreport']],
                                ['label' => 'รายงานอุบัติการแยกตาม Clinic , None Clinic', 'url' => ['/report/clinicnonereport']],
                                ['label' => 'รายงานอุบัติการแยกตาม PSG', 'url' => ['/report/psgreport']],
                            ], 'visible' => !Yii::$app->user->isGuest],
                        ['label' => '<i class="fa fa-cog"></i><span>ข้อมูลพื้นฐานของระบบ</span>',
                            'items' => [
                                ['label' => 'รหัสหน่วยงาน', 'url' => ['/dep']],
                                ['label' => 'สายงาน', 'url' => ['/team']],
                                ['label' => 'กลุ่มหน่วยงาน', 'url' => ['/group']],
                                ['label' => 'ที่มาของข้อมูล', 'url' => ['/source']],
                                ['label' => 'จัดการ User', 'url' => ['/user/admin/index']],
                            //['label' => 'Email Notification setting', 'url' => ['/severity']],
                            //['label' => 'setting', 'url' => ['/sys']],
                            ], 'visible' => $session['level'] == 5],
                        Yii::$app->user->isGuest ?
                                ['label' => '<i class="fa fa-user"></i><span>เข้าสู่ระบบ</span>', 'url' => ['/user/security/login']] :
                                ['label' => '<i class="fa fa-hand-o-right"></i>ผู้ใช้งานในระบบ', 'items' => [
                                ['label' => 'รายละเอียดผู้ใช้งาน', 'url' => ['/profile/update', 'id' => Yii::$app->user->identity->id]],
                                ['label' => 'รายระเอียด User', 'url' => ['/user/settings/account']],
                                ['label' => 'ออกจากระบบ', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
                            ]],
                        ['label' => '<i class="fa fa-user-plus"></i><span>ลงทะเบียน</span>', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest],
                        ['label' => '<i class="fa-cc-mastercard"></i><span> ทีมพัฒนา</span>', 'url' => ['site/about']],
                    ],
                ]
        );
        ?>

        <!--        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Same tools</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= \yii\helpers\Url::to(['/risk']) ?>"><span class="fa fa-file-code-o"></span> รายงานความเสี่ยง</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/debug']) ?>"><span class="fa fa-dashboard"></span> Debug</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>-->

    </section>

</aside>
