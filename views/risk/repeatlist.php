<?php
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\Html;
?>

<?php    Pjax::begin() ; ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'incident_detail',
        [
            'attribute' => 'pro_risk_id',
            'value' => 'prorisk.pro_risk_name',
        ],
        //'pro_risk_sub_detail_id',
        [
            'attribute' => 'pro_risk_detail_id',
            'value' => 'proriskdetail.pro_risk_detail_name',
        ],
        //'pro_risk_sub_detail_key',
        [
            'attribute' => 'pro_risk_sub_detail_id',
            'value' => 'prorisksubdetail.pro_risk_sub_detail_name',
        ],
        [
            'attribute' => 'incident_id',
            'value' => 'incident.incident_name',
        ],
        [ // แสดงข้อมูลออกเป็นสีตามเงื่อนไข
            'attribute' => 'follow_id',
            'format'=>'html',
            'value'=>function($model){
                return $model->follow_id==1 ? "<span style=\"color:green;\">ทบทวนแล้ว</span>":"<span style=\"color:red;\">ยังไม่ทบทวน</span>";
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{repeat} {delete}',
            'buttons' => [
                'repeat' => function($url,$model,$key) {
                    return Html::a('<i class="glyphicon glyphicon-check"></i>', $url);
                }
            ]
        ],
    ],
]); ?>
<?php Pjax::end() ; ?>