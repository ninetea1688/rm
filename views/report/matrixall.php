<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
?>
<div class="row">
<div class="col-md-4">
    <h3><div class="label label-info">Matrix ภาพรวม</div></h3>
</div>
</div>
<div class='well'>
    <form method="POST">
        ระหว่าง:
        <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date1',
            'value' => $date1,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ],
        ]);
        ?>
        ถึง:
        <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ]
        ]);
        ?>
        <button class='btn btn-danger'>ประมวลผล</button>
    </form>
</div>
<?php
if (isset($dataProvider))
//    print_r($dataProvider);
//return;
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel'=>$searchModel,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
        'responsive' => TRUE,
        'showPageSummary' => true,
        'hover' => true,
        
        'floatHeader' => true,
        'rowOptions' => function($model, $index, $widget, $grid) { 
    
      return ['class' => 'custom_class', 'style'=>'background-color:#'.$model['color'].''];
           },
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i></h3>',
            'before' => '',
            'type' => \kartik\grid\GridView::TYPE_SUCCESS,
        ],
        'columns' => [
         [
    'class'=>'kartik\grid\SerialColumn',
    'contentOptions'=>['class'=>'kartik-sheet-style'],
    'width'=>'36px',
    'header'=>'',
    'headerOptions'=>['class'=>'kartik-sheet-style']
],
//            [
//            'attribute' => 'cname',
//            'header' => 'วันที่เกิดความเสี่ยง'
//        ],
            'severity_level',
            'born_name',
          [
            'attribute' => 'date_risk',
            'header' => 'วันที่เกิดความเสี่ยง'
        ],
            [
            'attribute' => 'pro_risk_name',
            'header' => 'โปรแกรมความเสี่ยง'
        ],
            [
            'attribute' => 'pro_risk_detail_name',
            'header' => 'หมวดย่อย'
        ],
            [
            'attribute' => 'pro_risk_sub_detail_name',
            'header' => 'รายละเอียดหมวดย่อย'
        ], 
            [
            'attribute' => 'detail_prob',
            'header' => 'รายละเอียดความเสี่ยง'
        ],
             [
            'attribute' => 'dep_of_risk',
            'header' => 'แผนกที่เกิดความเสี่ยง'
        ],
             [
            'attribute' => 'method',
            'header' => 'วิธีการแก้ปัญหา'
        ],
             [
            'attribute' => 'follow_name',
            'header' => 'สถานะ'
        ],
             [
            'attribute' => 'name_report',
            'header' => 'ผู้รายงานความเสี่ยง'
        ],
               [
            'attribute' => 'name_edit',
            'header' => 'ผู้แก้ไขความเสี่ยง'
        ],
             
        ],
    ]);
?>




