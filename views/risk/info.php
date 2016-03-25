<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\Session;
use miloschuman\highcharts\Highcharts;
use yii\data\ActiveDataProvider;
use app\models\Risk;

$this->title = 'ระบบบริหารความเสี่ยง';
?>
<meta name="viewport" content="width=device-width, initial-scale=1">

<div class="page-header">
    <h2>รายงานความเสี่ยง</h2>
    <h3></h3>
</div>

<div class="row">
    <div class="col-md-6">
        <?php
        $n = [];
        $na=[];
        $command = Yii::$app->db->createCommand("select count(*) as c,cl.clinic_name as cn  from risk r 
join clinic cl ON r.clinic_id=cl.clinic_id 
GROUP BY r.clinic_id");
        $data = $command->queryAll();
        foreach ($data as $d) {
            array_push($n, intval($d['c']));
            array_push($na, $d['cn']);
        }
      
        echo Highcharts::widget([
               
            'options' => [
                'title' => ['text' => 'จำนวนความเสี่ยงแยกตามคลินิค'],
                'xAxis' => [
                    'categories' => $na
                ],
                'yAxis' => [
                    'title' => ['text' => 'จำนวนความเสี่ยง']
                ],
                'series' => [
                    ['type' => 'bar','name' => 'แยกตวามคลินิค', 'data' => $n],
                ]
    ]])
        ?>
    </div>
    <div class="col-md-4 col-md-offset-2">

        <div class="panel  panel-danger">
            <div class="panel-heading">
                
                    <a class="btn btn-block btn-lg btn-danger glyphicon glyphicon-pencil" href="<?= \yii\helpers\Url::to(['/risk/create']) ?>"> รายงานความเสี่ยง</a>
                
            </div>
        </div>
    </div>

</div>