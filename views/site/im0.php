<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JsExpression;
use miloschuman\highcharts\Highcharts;
use rmrevin\yii\fontawesome\FA;
rmrevin\yii\fontawesome\AssetBundle::register($this);
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
// matrix?>
<?php
        $c1 = Yii::$app->db->createCommand("SELECT COUNT(*) as mn,m.code_color as color,m.color as cname FROM risk r,matrix m
WHERE m.born_id = r.born_id and m.severity_level = r.severity_level
GROUP BY m.code_color");
        $q1 = $c1->queryAll();

        ///return;


        ?>

<div class="row">
    <div class="col-md-4">
        <h4><?php  echo FA::icon('fa fa-exclamation-circle')->rotate(FA::ROTATE_180);?>&nbsp;<div class="label label-success">ความเสี่ยงทั้งหมด <?=$noti1[0];?> ความเสี่ยง </div></h4>
        <h4><?php  echo FA::icon('fa fa-clock-o')->rotate(FA::ROTATE_180);?>&nbsp;<div class="label label-info">ความเสี่ยงในวัน <?=$noti3[0];?> ความเสี่ยง </div></h4>
        <h4><?php  echo FA::icon('fa fa-refresh fa-spin')->rotate(FA::ROTATE_90);?>&nbsp;<div class="label label-danger">ความเสี่ยงที่ไม่ได้แก้ไข <?=$noti2[0];?> ความเสี่ยง </div></h4>

    </div>


    <div class="col-md-6 col-md-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">ความเสี่ยงตาม Matrix</div>
            <div class="panel-body">
        <?php
                foreach ($q1 as $a1) {
         ?>
<div class="label custom_class" style="background-color:#<?=$a1['color'];?>">&nbsp;<?=$a1['cname'];?>&nbsp;  <?=$a1['mn'];?> เรื่อง </div>&nbsp;
<?php
        }
        ?>
            </div>
        </div>
    </div>

</div>
<div class="row">
  <div class="col-md-8">
     <div class="panel panel-primary">
         <div class="panel-heading">Matrix</div>
         <table class="table table-bordered">
<tr>
    <th class="info">โอกาศเกิด</th>
    <th class="info" colspan="4">ระดับความรุนแรง</th>


</tr>
<tr>
	<td class="">น้อย/ทุก 2-5 ปี</td>
	<td class="custom_class" style="background-color:green"></td>
	<td class="custom_class" style="background-color:green"></td>
	<td class="custom_class" style="background-color:yellow"></td>
	<td class="custom_class" style="background-color:yellow"></td>
</tr>
<tr>
	<td class="">ปานกลาง/ทุกปี</td>
	<td class="custom_class" style="background-color:green"></td>
	<td class="custom_class" style="background-color:yellow"></td>
	<td class="custom_class" style="background-color:orange"></td>
	<td class="custom_class" style="background-color:orange"></td>
</tr>
<tr>
	<td class="">สูง/ทุกเดือน</td>
	<td class="custom_class" style="background-color:yellow"></td>
	<td class="custom_class" style="background-color:orange"></td>
	<td class="custom_class" style="background-color:red"></td>
	<td class="custom_class" style="background-color:red"></td>
</tr>
<tr>
	<td class="">สูงมาก/ทุกวัน</td>
  <td class="custom_class" style="background-color:yellow"></td>
  <td class="custom_class" style="background-color:orange"></td>
  <td class="custom_class" style="background-color:red"></td>
  <td class="custom_class" style="background-color:red"></td>
</tr>
</table>
     </div>
</div>
</div>
<div class="row">
    <div class="col-md-5">
        <?php
        $n = [1,1,1];
        $na = [];
        $command = Yii::$app->db->createCommand("select count(*) as c,cl.clinic_name as cn  from risk r
join clinic cl ON r.clinic_id=cl.clinic_id
GROUP BY r.clinic_id");
        $data = $command->queryAll();
        foreach ($data as $d) {
            array_push($n, intval($d['c']));
        }

        $dill=[0];
        $dill2=[0];
        $dill3=[0];
        $command1 = Yii::$app->db->createCommand("SELECT COUNT(*) as n,concat('รุนแรงระดับ : ',r.severity_level) as se FROM risk r
LEFT OUTER JOIN severity s ON r.severity_level=s.severity_text
WHERE r.clinic_id =1 AND r.severity_level IS NOT NULL GROUP BY r.severity_level");
        $data1 = $command1->queryAll();
        foreach ($data1 as $d1) {
            $dill[] = [
                'name' => $d1['se'],
                'y' => intval($d1['n'])
            ];
        }
//drill2
        $command2 = Yii::$app->db->createCommand("SELECT COUNT(*) as n,concat('รุนแรงระดับ : ',r.severity_level) as se FROM risk r
LEFT OUTER JOIN severity s ON r.severity_level=s.severity_text
WHERE r.clinic_id =2 AND r.severity_level IS NOT NULL GROUP BY r.severity_level");
        $data2 = $command2->queryAll();
        foreach ($data2 as $d2) {
            $dill2[] = [
                'name' => $d2['se'],
                'y' => intval($d2['n'])
            ];
        }
//drill3
        $command3 = Yii::$app->db->createCommand("SELECT COUNT(*) as n,concat('รุนแรงระดับ : ',r.severity_level) as se FROM risk r
LEFT OUTER JOIN severity s ON r.severity_level=s.severity_text
WHERE r.clinic_id =3 AND r.severity_level IS NOT NULL GROUP BY r.severity_level");
        $data3 = $command3->queryAll();
        foreach ($data3 as $d3) {
            $dill3[] = [
                'name' => $d3['se'],
                'y' => intval($d3['n'])
            ];
        }
        echo Highcharts::widget([
            'scripts' => [
                'highcharts-more',
                'modules/exporting',
                'themes/grid-light',
                'highcharts-3d',
                'modules/drilldown',
            ],
            'options' => [
                'title' => [
                    'text' => 'สรุปความเสี่ยงแยกตามคลินิค',
                ],
                'labels' => [
                    'items' => [
                        [
                            'html' => 'สรุปจำนวนตามคลินิค',
                        ],
                    ],
                ],
                'series' => [
                    [
                        'type' => 'pie',
                        'name' => 'จำนวน',
                        'data' => [
                            [
                                'name' => 'คลินิดทั่วไป',
                                'y' => $n[0],
                                'drilldown' => '1',
                            ],
                            [
                                'name' => 'คลินิคเฉพาะทาง',
                                'y' => $n[1],
                                'drilldown' => '2',
                            ],
                            [
                                'name' => 'ความเสี่ยงทั่วไป',
                                'y' => $n[2],
                                'drilldown' => '3',
                            ],
                        ],
                        //'center' => [100, 80],
                        //'size' => 100,
                        'showInLegend' => TRUE,
                        'dataLabels' => [
                            'enabled' => TRUE,
                        ],
                    ],
                ],
                //dill
                'drilldown' => [
                    'series' => [
                        [
                            'type' => 'pie',
                            'id' => '1',
                            'name' => 'คลินิคทั่วไป',
                            'data' => $dill
                        ],
                        [
                            'type' => 'pie',
                            'id' => '2',
                            'name' => 'คลินิคเฉพาะ',
                            'data' => $dill2
                        ],
                        [
                            'type' => 'pie',
                            'id' => '3',
                            'name' => 'ความเสี่ยงทั่วไป',
                            'data' => $dill3
                        ],
                    ],
                ],
            //end dill
            ]
        ]);
        ?>
    </div>
    <div class="col-md-6 col-md-offset-1">
        <?=
        \yii2fullcalendar\yii2fullcalendar::widget(array(
            'events' => $events,
        ));
        ?>
    </div>
</div>
