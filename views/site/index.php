<?php

use yii\db\Query;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JsExpression;
use miloschuman\highcharts\Highcharts;
use rmrevin\yii\fontawesome\FA;

rmrevin\yii\fontawesome\AssetBundle::register($this);

$connection = \Yii::$app->db;
$this->title = 'ระบบบริหารความเสี่ยง';
?>
<?php
///// กล่องแรก
$noti1 = [];
$noti2 = [];
$noti3 = [];
$c = Yii::$app->db->createCommand("SELECT
COUNT(*) AS total,
SUM(CASE WHEN (follow_id <>1 or follow_id is NULL) THEN 1 ELSE 0 END) as un
,SUM(CASE WHEN date_stamp=DATE(now()) THEN 1 ELSE 0 END) as date
 FROM risk ");
$q = $c->queryAll();
foreach ($q as $a) {
    array_push($noti1, intval($a['total']));
    array_push($noti2, intval($a['un']));
    array_push($noti3, intval($a['date']));
}
//end
// matrix
?>
<div class="site-index">
    <div class="row">
        <div class="jumbotron">
            <h2>ขอต้อนรับเข้าสู่ระบบบริหารความเสี่ยง </h2>
            <p class="lead">พัฒนาด้วย YII2 PHP Framwork</p>
<?php echo Html::a('<i class="fa fa-list-ol "></i><span>เข้าสู่เว็ปไซต์โรงพยาบาลเขื่องใน</span>', 'http://www.knhosp.go.th', ['class' => 'btn btn-info']); ?>
        </div>

    </div>

</div>


<div id="wrapper">

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">&nbsp;</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->



        <!-- /.row -->
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">รายงานสรุป </div>
                    <div class="panel-body">
                        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#999999">
                            <tbody>
                                <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                    <td bgcolor="#fdfbf9" align="center"><div align="left">1.<span class="style3"><a href="<?= \yii\helpers\Url::to(['/site/im']) ?>">รายงานสรุปภาพรวม</a></span></div></td>
                                </tr>
                            </tbody>
                        </table>
                        <p>&nbsp;</p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <div class="col-lg-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">รายงานความเสี่ยง</div>
                    <div class="panel-body">
                        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#999999">
                            <tbody>
                                <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                    <td bgcolor="#fdfbf9" align="center"><div align="left">1.<span class="style3"><a href="<?= \yii\helpers\Url::to(['/risk/info']) ?>">จำนวนความเสี่ยงแยกตามคลินิค</a></span></div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer"></div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <div class="col-lg-4">
                <div class="panel panel-success">

                    <div class="panel-heading">แก้ไขความเสี่ยง</div>
                    <div class="panel-body">
                        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#999999">
                            <tbody>
                                <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                    <td bgcolor="#fdfbf9" align="center"><div align="left">1.<span class="style3"><a href="<?= \yii\helpers\Url::to(['/risk/edit']) ?>">ข้อมูลการแก้ไขความเสี่ยง</a></span></div></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                    <div class="panel-footer"></div>
                </div>
                <!-- /.col-lg-4 -->

            </div>
        </div>




        <!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <div class="panel panel-danger">
                <div class="panel-heading">ระบบรายงานต่างๆ</div>
                <div class="panel-body">
                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#999999">
                        <tbody>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">1.<a href="<?= \yii\helpers\Url::to(['/report/userreport']) ?>">จำนวนความเสี่ยงรายบุคล/บุคคลในหน่วยงาน</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">2.<a href="<?= \yii\helpers\Url::to(['/report/teamreport']) ?>">จำนวนความเสี่ยงรายบุคล/บุคคลในทีม</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">3.<a href="<?= \yii\helpers\Url::to(['/report/sumdep']) ?>">สรุปจำนวนความเสี่ยงแยกตามหน่วยงาน</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">4.<a href="<?= \yii\helpers\Url::to(['/report/sumteam']) ?>">สรุปจำนวนความเสี่ยงตามทีมคล่อมสายงาน</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">5.<a href="<?= \yii\helpers\Url::to(['/report/matrixall']) ?>">รายงาน matrix ภาพรวม</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">6.<a href="<?= \yii\helpers\Url::to(['/report/matrixdep']) ?>">รายงาน matrix หน่วยงาน</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">7.<a href="<?= \yii\helpers\Url::to(['/report/missandnearreport']) ?>">รายงานอุบัติการ Miss and Near Miss</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">8.<a href="<?= \yii\helpers\Url::to(['/report/incidentaireport']) ?>">รายงานอุบัติการแยกระดับความรุนแรง</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">9.<a href="<?= \yii\helpers\Url::to(['/report/smlreport']) ?>">รายงานอุบัติการแยกระดับความรุนแรง น้อย ปานกลาง มาก</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">10.<a href="<?= \yii\helpers\Url::to(['/report/programseverityreport']) ?>">รายงานอุบัติการ แยกตามโปรแกรมความเสี่ยง แยกระดับความรุนแรง</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">11.<a href="<?= \yii\helpers\Url::to(['/report/allclinicreport']) ?>">รายงานอุบัติการแยกตามคลินิค</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">12.<a href="<?= \yii\helpers\Url::to(['/report/clinicnonereport']) ?>">รายงานอุบัติการแยกตาม Clinic , None Clinic</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">13.<a href="<?= \yii\helpers\Url::to(['/report/psgreport']) ?>">รายงานอุบัติการแยกตาม PSG</a></div></td>
                            </tr>

                        </tbody>
                    </table>
                    <p>&nbsp;</p>
                </div>
                <div class="panel-footer"></div>
            </div>
        </div>
        <!-- /.col-lg-4 -->



        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-info">
                <div class="panel-heading"><span class="style2">ข้อมูลพื้นฐานของระบบ</span></div>
                <div class="panel-body">
                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#999999">
                        <tbody>

                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">1.<a href="<?= \yii\helpers\Url::to(['/dep']) ?>">รหัสหน่วยงาน</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">2.<a href="<?= \yii\helpers\Url::to(['/team']) ?>">สายงาน</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">3.<a href="<?= \yii\helpers\Url::to(['/profile']) ?>">จัดการ profile</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">4.<a href="<?= \yii\helpers\Url::to(['/prorisk']) ?>">จัดการโปรแกรมความเสี่ยงหลัก</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">5.<a href="<?= \yii\helpers\Url::to(['/proriskdetail']) ?>">จัดการโปรแกรมความเสี่ยงย่อย</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">6.<a href="<?= \yii\helpers\Url::to(['/prorisksubdetail']) ?>">จัดการกระบวนการ</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">7.<a href="<?= \yii\helpers\Url::to(['/incident']) ?>">จัดการอุบัติการณ์</a></div></td>
                            </tr>                                
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">8.<a href="<?= \yii\helpers\Url::to(['/severity']) ?>">จัดการระดับความรุนแรง</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">9.<a href="<?= \yii\helpers\Url::to(['/group']) ?>">กลุ่มหน่วยงาน</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">10.<a href="<?= \yii\helpers\Url::to(['/source']) ?>">ที่มาของข้อมูล</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">11.<a href="<?= \yii\helpers\Url::to(['/user/admin/index']) ?>">จัดการ User</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">12.<a href="<?= \yii\helpers\Url::to(['/psg']) ?>">จัดการ PSG</a></div></td>
                            </tr>
                            <tr bordercolor="#999999" bgcolor="#fdfbf9">
                                <td bgcolor="#fdfbf9" colspan="2" align="center"><div align="left">13.<a href="<?= \yii\helpers\Url::to(['/psgprogram']) ?>">จัดการอุบัติการณ์ในกลุ่ม PSG</a></div></td>
                            </tr>
                            

                        </tbody>
                    </table>
                </div>








                <!-- /.row -->
                <div class="row">
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <!-- /.col-lg-6 -->
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <!-- /.col-lg-4 -->
                    <!-- /.col-lg-4 -->
                    <!-- /.col-lg-4 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
