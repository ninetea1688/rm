<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
?>

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
        'hover' => true,
        'floatHeader' => true,
        'panel' => [
            'before' => '',
            'type' => \kartik\grid\GridView::TYPE_SUCCESS,
            
        ],
        'columns' => [
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




