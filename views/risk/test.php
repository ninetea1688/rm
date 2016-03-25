<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<h1>รายการทั้งหมด</h1>
<p>
    <?= Html::a('เพิ่มข้อมูล',['create'],['class'=>'btn btn-success']);?>
</p>
<?= GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        ['class'=>'yii\grid\SerialColumn'],//ลำดับคอลัมน์
        'pro_risk_id',//หัวข้อ
        //'description',//รายละเอียด
        //'created',//โพสเมื่อ
        ['class'=>'yii\grid\ActionColumn'],//action button
    ]
]);?>

