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
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-user"></i> รายงานอุบัติการแยกระดับความรุนแรง</h5></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                Pjax::begin();
                                echo Highcharts::widget([
                                    'options' => [
                                        'title' => ['text' => 'ระดับความรุนแรง'],
                                        'xAxis' => [
                                            'categories' => $severity_level
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'จำนวนอุบัติการ']
                                        ],
                                        'series' => [
                                            ['type' => 'column',
                                                'name' => 'จำนวนอุบัติการ',
                                                'data' => $numx,
                                                //'color' => '#F5C4B6',
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
                                            'label' => 'ระดับความรุนแรง',
                                            'attribute' => 'severity_level',

                                        ],
                                        [
                                            'label' => 'จำนวน',
                                            'attribute' => 'numx',
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