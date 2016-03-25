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
        $c1 = Yii::$app->db->createCommand("SELECT
SUM(CASE WHEN r.born_id=1 AND m.score=0 THEN 1 ELSE 0 END ) AS r1c1
,SUM(CASE WHEN r.born_id=1 AND m.score=1 THEN 1 ELSE 0 END ) AS r1c2
,SUM(CASE WHEN r.born_id=1 AND m.score=2 THEN 1 ELSE 0 END ) AS r1c3
,SUM(CASE WHEN r.born_id=1 AND m.score=3 THEN 1 ELSE 0 END ) AS r1c4
,SUM(CASE WHEN r.born_id=1 AND m.score=4 THEN 1 ELSE 0 END ) AS r1c5

,SUM(CASE WHEN r.born_id=2 AND m.score=0 THEN 1 ELSE 0 END ) AS r2c1
,SUM(CASE WHEN r.born_id=2 AND m.score=1 THEN 1 ELSE 0 END ) AS r2c2
,SUM(CASE WHEN r.born_id=2 AND m.score=2 THEN 1 ELSE 0 END ) AS r2c3
,SUM(CASE WHEN r.born_id=2 AND m.score=3 THEN 1 ELSE 0 END ) AS r2c4
,SUM(CASE WHEN r.born_id=2 AND m.score=4 THEN 1 ELSE 0 END ) AS r2c5

,SUM(CASE WHEN r.born_id=3 AND m.score=0 THEN 1 ELSE 0 END ) AS r3c1
,SUM(CASE WHEN r.born_id=3 AND m.score=1 THEN 1 ELSE 0 END ) AS r3c2
,SUM(CASE WHEN r.born_id=3 AND m.score=2 THEN 1 ELSE 0 END ) AS r3c3
,SUM(CASE WHEN r.born_id=3 AND m.score=3 THEN 1 ELSE 0 END ) AS r3c4
,SUM(CASE WHEN r.born_id=3 AND m.score=4 THEN 1 ELSE 0 END ) AS r3c5

,SUM(CASE WHEN r.born_id=4 AND m.score=0 THEN 1 ELSE 0 END ) AS r4c1
,SUM(CASE WHEN r.born_id=4 AND m.score=1 THEN 1 ELSE 0 END ) AS r4c2
,SUM(CASE WHEN r.born_id=4 AND m.score=2 THEN 1 ELSE 0 END ) AS r4c3
,SUM(CASE WHEN r.born_id=4 AND m.score=3 THEN 1 ELSE 0 END ) AS r4c4
,SUM(CASE WHEN r.born_id=4 AND m.score=4 THEN 1 ELSE 0 END ) AS r4c5

FROM risk r,matrix m,born b
WHERE m.born_id = r.born_id and m.severity_level = r.severity_level AND r.born_id=b.born_id
");
        $q1 = $c1->queryAll();
     foreach($q1 as $ma){
            $r1c1=$ma['r1c1'];
            $r1c2=$ma['r1c2'];
            $r1c3=$ma['r1c3'];
            $r1c4=$ma['r1c4'];
            $r1c5=$ma['r1c5'];

            $r2c1=$ma['r2c1'];
            $r2c2=$ma['r2c2'];
            $r2c3=$ma['r2c3'];
            $r2c4=$ma['r2c4'];
            $r2c5=$ma['r2c5'];
            
            $r3c1=$ma['r3c1'];
            $r3c2=$ma['r3c2'];
            $r3c3=$ma['r3c3'];
            $r3c4=$ma['r3c4'];
            $r3c5=$ma['r3c5'];
            
            $r4c1=$ma['r4c1'];
            $r4c2=$ma['r4c2'];
            $r4c3=$ma['r4c3'];
            $r4c4=$ma['r4c4'];
            $r4c5=$ma['r4c5'];
}

         ?>

<div class="row">
    <div class="col-md-4">
        <h4><?php  echo FA::icon('fa fa-list-ol')->rotate(FA::ROTATE_180);?>&nbsp;<div class="label label-success">ความเสี่ยงทั้งหมด <?=$noti1[0];?> ความเสี่ยง </div></h4>
        <h4><?php  echo FA::icon('fa fa-calendar')->rotate(FA::ROTATE_180);?>&nbsp;<div class="label label-info">ความเสี่ยงในวัน <?=$noti3[0];?> ความเสี่ยง </div></h4>
        <h4><?php  echo FA::icon('fa fa-exclamation-triangle');?>&nbsp;<div class="label label-danger">ความเสี่ยงที่ไม่ได้แก้ไข <?=$noti2[0];?> ความเสี่ยง </div></h4>

    </div>
    
<!--start table--> 
    <div class="col-md-8">
       <div class="panel">
          <table class="table">
  <tr>
      <th class="primary"><center>โอกาศเกิด</center></th>
      <th class="" colspan="5"><center>ระดับความรุนแรง</center></th>


  </tr>
  <tr>
  	<th class="">น้อย/ทุก 2-5 ปี</th>
        <td class="custom_class" style="background-color:#cccccc">
            <center><?= Html::a($r1c1, ['/report/matrixlink','born' =>1,'score'=>0], ['class'=>'btn btn-info']) ?></center>

          <td class="custom_class" style="background-color:#009966">
          <center><?= Html::a($r1c2, ['/report/matrixlink','born' =>1,'score'=>1], ['class'=>'btn btn-info']) ?></center>
          </td>
          <td class="custom_class" style="background-color:#009966">
         <center><?= Html::a($r1c3, ['/report/matrixlink','born' =>1,'score'=>2], ['class'=>'btn btn-info']) ?></center>
          </td>
          <td class="custom_class" style="background-color:yellow">
          <center><?= Html::a($r1c4, ['/report/matrixlink','born' =>1,'score'=>3], ['class'=>'btn btn-info']) ?></center>
          </td>
          <td class="custom_class" style="background-color:yellow">
         <center><?= Html::a($r1c5, ['/report/matrixlink','born' =>1,'score'=>4], ['class'=>'btn btn-info']) ?></center>
          </td>
  </tr>
  <tr>
  	<th class="">ปานกลาง/ทุกปี</th>
        <td class="custom_class" style="background-color:#cccccc">
  <center><?= Html::a($r2c1, ['/report/matrixlink','born' =>2,'score'=>0], ['class'=>'btn btn-info']) ?></center>
          </td>
          <td class="custom_class" style="background-color:#009966">
        <center><?= Html::a($r2c2, ['/report/matrixlink','born' =>2,'score'=>1], ['class'=>'btn btn-info']) ?></center>
          </td>
  	<td class="custom_class" style="background-color:yellow">
       <center><?= Html::a($r2c3, ['/report/matrixlink','born' =>2,'score'=>2], ['class'=>'btn btn-info']) ?></center>
          </td>
  	<td class="custom_class" style="background-color:orange">
        <center><?= Html::a($r2c4, ['/report/matrixlink','born' =>2,'score'=>3], ['class'=>'btn btn-info']) ?></center>
          </td>
  	<td class="custom_class" style="background-color:orange">
        <center><?= Html::a($r2c5, ['/report/matrixlink','born' =>2,'score'=>4], ['class'=>'btn btn-info']) ?></center>
          </td>
  </tr>
  <tr>
  	<th class="">สูง/ทุกเดือน</th>
        <td class="custom_class" style="background-color:#cccccc">
  <center><?= Html::a($r3c1, ['/report/matrixlink','born' =>3,'score'=>0], ['class'=>'btn btn-info']) ?></center>
          </td>
  	<td class="custom_class" style="background-color:yellow">
        <center><?= Html::a($r3c2, ['/report/matrixlink','born' =>3,'score'=>1], ['class'=>'btn btn-info']) ?></center>
          </td>
  	<td class="custom_class" style="background-color:orange">
        <center><?= Html::a($r3c3, ['/report/matrixlink','born' =>3,'score'=>2], ['class'=>'btn btn-info']) ?></center>
          </td>
  	<td class="custom_class" style="background-color:red">
        <center><?= Html::a($r3c4, ['/report/matrixlink','born' =>3,'score'=>3], ['class'=>'btn btn-info']) ?></center>
          </td>
  	<td class="custom_class" style="background-color:red">
        <center><?= Html::a($r3c5, ['/report/matrixlink','born' =>3,'score'=>4], ['class'=>'btn btn-info']) ?></center>
          </td>
  </tr>
  <tr>
  	<th class="">สูงมาก/ทุกวัน</th>
       <td class="custom_class" style="background-color:#cccccc">
  <center><?= Html::a($r4c1, ['/report/matrixlink','born' =>4,'score'=>0], ['class'=>'btn btn-info']) ?></center>
          </td>
    <td class="custom_class" style="background-color:yellow">
<center><?= Html::a($r4c2, ['/report/matrixlink','born' =>4,'score'=>1], ['class'=>'btn btn-info']) ?></center>
    </td>
    <td class="custom_class" style="background-color:orange">
    <center><?= Html::a($r4c3, ['/report/matrixlink','born' =>4,'score'=>2], ['class'=>'btn btn-info']) ?></center>
          </td>
    <td class="custom_class" style="background-color:red">
    <center><?= Html::a($r4c4, ['/report/matrixlink','born' =>4,'score'=>3], ['class'=>'btn btn-info']) ?></center>
          </td>
    <td class="custom_class" style="background-color:red">
    <center><?= Html::a($r4c5, ['/report/matrixlink','born' =>4,'score'=>4], ['class'=>'btn btn-info']) ?></center>
          </td>
  </tr>
  </table>
       </div>
  </div>
<!--End table-->

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
