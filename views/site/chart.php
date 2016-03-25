<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
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
                'name' => 'Total consumption',
                'data' => [
                    [
                        'name' => 'คลินิคทั่วไป',
                        'y' => 13,
                        'color' => new JsExpression('Highcharts.getOptions().colors[0]'),
                         'drilldown'=> 'Microsoft Internet Explorer',
                    ],
                    [
                        'name' => 'คลินิคเฉพาะโรค',
                        'y' => 23,
                        'color' => new JsExpression('Highcharts.getOptions().colors[1]'), // John's color
                    ],
                    [
                        'name' => 'ความเสี่ยงทั่วไปหห',
                        'y' => 19,
                        'color' => new JsExpression('Highcharts.getOptions().colors[2]'), // Joe's color
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
        
    ]
]);