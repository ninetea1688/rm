<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use \miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
$this->title = 'ผู้พัฒนา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel-body">
    <div class="panel panel-primary">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-plus"></i> ผู้พัฒนา</h4></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-user"></i> ทีมพัฒนา</h5></div>
                        <div class="panel-body">
                            <div>
                                <img src="dev/bomkeen.jpg" width="420">
                            </div>
                            <br>
                            <div class="kv-panel-pager">
                                คุณอลิษา พลเดช สำนักงานสาธารณสุขจังหวัดพระนครศรีอยุธยา<p>
                                email :: iamaliz@gmail.com<p>
                                line id :: bomkeen<p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-list-alt"></i> ทีมพัฒนา</h5></div>
                        <div class="panel-body">
                            <div>
                                <img src="dev/tea.jpg" width="420">
                            </div>
                            <br>
                             <div class="kv-panel-pager">
                                 คุณสุรชัย ศรีอาราม โรงพยาบาลเขื่องใน จังหวัดอุบลราชธานี<p>
                                 email :: ninetea@gmail.com<p>
                                 line id :: cybernude<p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
