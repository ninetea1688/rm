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
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-user"></i> รายงานอุบัติการ แยกตามโปรแกรมความเสี่ยง แยกระดับความรุนแรง</h5></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                Pjax::begin();
                                echo Highcharts::widget([
                                    'options' => [
                                        'title' => ['text' => 'โปรแกรมความเสี่ยงหลัก'],
                                        'xAxis' => [
                                            'categories' => $pro_risk_name
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'จำนวนอุบัติการ']
                                        ],
                                        'series' => [
                                            ['type' => 'column',
                                                'name' => 'ระดับความรุนแรง A',
                                                'data' => $allA,
                                                //'color' => '#F5C4B6',
                                            ],
                                            ['type' => 'column',
                                                'name' => 'ระดับความรุนแรง B',
                                                'data' => $allB,
                                                //'color' => '#F5C4B6',
                                            ],
                                            ['type' => 'column',
                                                'name' => 'ระดับความรุนแรง C',
                                                'data' => $allC,
                                                //'color' => '#F5C4B6',
                                            ],
                                            ['type' => 'column',
                                                'name' => 'ระดับความรุนแรง D',
                                                'data' => $allD,
                                                //'color' => '#F5C4B6',
                                            ],
                                            ['type' => 'column',
                                                'name' => 'ระดับความรุนแรง E',
                                                'data' => $allE,
                                                //'color' => '#F5C4B6',
                                            ],
                                            ['type' => 'column',
                                                'name' => 'ระดับความรุนแรง F',
                                                'data' => $allF,
                                                //'color' => '#F5C4B6',
                                            ],
                                            ['type' => 'column',
                                                'name' => 'ระดับความรุนแรง G',
                                                'data' => $allG,
                                                //'color' => '#F5C4B6',
                                            ],
                                            ['type' => 'column',
                                                'name' => 'ระดับความรุนแรง H',
                                                'data' => $allH,
                                                //'color' => '#F5C4B6',
                                            ],
                                            ['type' => 'column',
                                                'name' => 'ระดับความรุนแรง I',
                                                'data' => $allI,
                                                //'color' => '#F5C4B6',
                                            ],
                                        ],
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
                                            'label' => 'โปรแกรมความเสี่ยงหลัก',
                                            'attribute' => 'pro_risk_name',
                                            'format' => 'raw',
                                            'value' => function($model)use($pro_risk_name) {
                                                return Html::a(Html::encode($model['pro_risk_name']), [
                                                    'report/subprogramseveritylevel1/',
                                                    'pro_risk_id' => $model['pro_risk_id'],
                                                ]);
                                            }
                                        ],
                                        [
                                            'label' => 'ระดับความรุนแรง A',
                                            'attribute' => 'allA',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'ระดับความรุนแรง B',
                                            'attribute' => 'allB',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'ระดับความรุนแรง C',
                                            'attribute' => 'allC',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'ระดับความรุนแรง D',
                                            'attribute' => 'allD',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'ระดับความรุนแรง E',
                                            'attribute' => 'allE',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'ระดับความรุนแรง F',
                                            'attribute' => 'allF',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'ระดับความรุนแรง G',
                                            'attribute' => 'allG',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'ระดับความรุนแรง H',
                                            'attribute' => 'allH',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'ระดับความรุนแรง I',
                                            'attribute' => 'allI',
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