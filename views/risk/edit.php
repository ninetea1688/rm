<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\Session;
use app\models\Risk;
use miloschuman\highcharts\Highcharts;

$this->title = 'ระบบบริหารความเสี่ยง';
?>
<meta name="viewport" content="width=device-width, initial-scale=1">

<div class="page-header">
    <h3></h3>
</div>
<div class="row">
    <div class="col-md-6">
        <?php
        $n = [];
        $na=[];
        $command = Yii::$app->db->createCommand("select count(*) as c,f.follow_name as cn  from risk r 
JOIN follow f ON r.follow_id=f.follow_id
GROUP BY r.follow_id");
        $data = $command->queryAll();
        foreach ($data as $d) {
            array_push($n, intval($d['c']));
            array_push($na, $d['cn']);
        }
      
        echo Highcharts::widget([
               
            'options' => [
                'title' => ['text' => 'ข้อมูลการแก้ไขความเสี่ยง'],
                'xAxis' => [
                    'categories' => $na
                ],
                'yAxis' => [
                    'title' => ['text' => 'จำนวนความเสี่ยง']
                ],
                'series' => [
                    ['name' => 'แยกตวามประเภทการแก้ไข', 'data' => $n],
                ]
    ]])
        ?>
    </div>

    <div class="col-md-4 col-md-offset-2">

        <div class="panel  panel-info">
            <div class="panel-heading">
                    <a class="btn btn-block btn-lg btn-info glyphicon glyphicon-exclamation-sign" href="<?= \yii\helpers\Url::to(['/risk/']) ?>"> ความเสี่ยงทั้งหมด</a>
                    <a class="btn btn-block btn-lg btn-info glyphicon glyphicon-exclamation-sign" href="<?= \yii\helpers\Url::to(['/risk/riskdep']) ?>"> ความเสี่ยงทั้งหมดของแผนก</a>
                    <a class="btn btn-block btn-lg btn-info glyphicon glyphicon-exclamation-sign" href="<?= \yii\helpers\Url::to(['/risk/riskteam']) ?>"> ความเสี่ยงทั้งหมดทีมคล่อมสายงาน</a>
                
            </div>
        </div>
    </div>

</div>