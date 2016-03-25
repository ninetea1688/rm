<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use app\models\Profile;
use app\models\Level;
use app\models\Dep;

        $uid = Yii::$app->user->identity->id;
        $gp = Profile::findOne(['user_id' => $uid]) ;
        $dep = $gp->dep_id;    
        
        $session = Yii::$app->session;
        //$name = $session['fullname'];
        $name = $gp->name;
        //$dep = $session['dep'];
        $g= Dep::findOne(['dep_id'=>$dep]);
        //$l=$session['level'];
        $l = $gp->level_id;
        $ln=  Level::findOne(['level_id'=>$l]);

?>
<div class="row">
<div class="col-md-12">
    <h3><div class="label label-info">สรุปการรายงานความเสี่ยงของ <?php echo $name;?></div> &nbsp<div class="label label-info"> หน่วยงาน <?php echo $g->dep_name;?> </div> </h3>
    <h5><div class="label label-warning">เข้าใช้งานนฐานะ <?php echo $ln->level_name;?></div></h5>
   
</div>
</div>
<div class='well'>
    <form method="POST" class="form-inline">
        <div class="form-group">
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
        </div>
            <?php
            $session = Yii::$app->session;
        $u=Yii::$app->user->identity->id;
        if ($l == 1) {
echo yii\helpers\Html::hiddenInput('user', $value=$u);
            }else {
            $d = $dep;
        $list = yii\helpers\ArrayHelper::map(Profile::find()->where(['dep_id' => $d])->all(), 'user_id', 'name');
        
         
        echo yii\helpers\Html::dropDownList('user', $user, $list, [
                    'prompt' => 'รายชื่อบุคลในแผนก',
                    'class' => 'form-control',
                    
                    
        ]);}
                ?>
        
        <button class='btn btn-danger'>ประมวลผล</button>
    </form>
</div>
<div class="row">
    <div class="col-md-12">
<?php
if (isset($dataProvider))
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
        'responsive' => TRUE,
        //'showPageSummary' => true,
        'hover' => true,
        'floatHeader' => true,
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i></h3>',
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

</div>

</div>
