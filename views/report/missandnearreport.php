<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use \miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

$this->title = 'ระบบรายงานสารสนเทศ โรงพยาบาลเขื่องใน';
?>
<div class="panel-body">
    <div class="panel panel-primary">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-plus"></i> รายงานความเสี่ยง</h4></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-user"></i> รายงานอุบัติการ Miss and Near Miss</h5></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                Pjax::begin();
                                echo Highcharts::widget([
                                    'options' => [
                                        'title' => ['text' => 'อุบัติการ'],
                                        'xAxis' => [
                                            'categories' => ''
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'จำนวน (คน/ครั้ง) ']
                                        ],
                                        'series' => [
                                            ['type' => 'column',
                                                'name' => 'เกือบพลาด',
                                                'data' => $nearmiss,
                                                //'color' => '#F5C4B6',
                                            ],
                                            [
                                                'type' => 'column',
                                                'name' => 'พลาด',
                                                'data' => $miss,
                                                'format' => ['decimal', 0]
                                                //'color' => '#BF0B23',
                                            ],
                                        ]
                                    ]
                                ]);
                                Pjax::end();
                                ?>
                            </div>


                            <div>
                                <?php
                                //use yii\grid\GridView;


                                echo GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                    ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label' => 'เกือบพลาด (NearMiss)',
                                            'attribute' => 'nearmiss',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'พลาด (Miss)',
                                            'attribute' => 'miss',
                                            'format' => ['decimal', 0]
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>