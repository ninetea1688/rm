<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
?>
<div class="row">
<div class="col-md-4">
    <h3><div class="label label-info">รายงานสรุปความเสี่ยงแยกตามหน่วยงาน</div></h3>
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
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
        'responsive' => TRUE,
        'showPageSummary' => true,
        'hover' => true,
        'floatHeader' => true,
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i></h3>',
            'before' => '',
            'type' => \kartik\grid\GridView::TYPE_SUCCESS,
            
        ],
        'columns' => [
            [
            'attribute' => 'dep_name',
            'header' => 'หน่วยงาน',
                'pageSummary'=>'รวม'
                
        ],
            [
            'attribute' => 'n',
            'header' => 'จำนวนความเสี่ยงทั้งหมด',
                'pageSummary'=>true
        ],
            [
            'attribute' => 'fix',
            'header' => 'ความเสี่ยงที่แก้ไขแล้ว',
                'pageSummary'=>true
        ],
            [
            'attribute' => 'nofix',
            'header' => 'ยังไม่ได้แก้ไข',
                'pageSummary'=>true
        ], 
     
           
        ],
    ]);
?>




