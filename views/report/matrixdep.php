<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\web\Session;
use yii\bootstrap\Dropdown;
use app\models\Dep;
use app\models\Level;
use app\models\Prorisk;
use app\models\Profile;

$session = Yii::$app->session;

        $uid = Yii::$app->user->identity->id;
        $gp = Profile::findOne(['user_id' => $uid]) ;
        $dep = $gp->dep_id;   
        
        
        //$d = $session['dep'];
        $d = $dep;
        $g= Dep::findOne(['dep_id'=>$d]);
        //$l=$session['level'];
        $l = $gp->level_id;
        $ln=  Level::findOne(['level_id'=>$l]);
 ?>
    <div class="page-header">
        <h3> Matrix ของหน่วยงาน <?php echo $g->dep_name;?></h3>
        <h4><div class="label label-warning glyphicon glyphicon-alert">  เข้าดูในฐานะ<?php echo $ln->level_name;?>   สามารถเขาดูหน่วยงานได้ตามสิทธิการใช้งานเท่านั้น</div></h4>
       
   </div>

<div class='well'>
    <form method="POST" class="form-inline">
        <div class="form-group">
         <label for="date1">ระหว่าง:</label>
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
          <label for="date2">ถึง:</label>
       
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
        $d = $dep;
        if ($l == 1) {
                $list = yii\helpers\ArrayHelper::map(dep::find()->where(['dep_id' => $d])->all(), 'dep_id', 'dep_name');
        }else {
            $d = $dep;
        $g = Dep::find()->select('group_id')->where(['dep_id' => $d]);
        $list = yii\helpers\ArrayHelper::map(dep::find()->where(['group_id' => $g])->all(), 'dep_id', 'dep_name');
        }
         
        echo yii\helpers\Html::dropDownList('dep', $dep, $list, [
                    'prompt' => 'เลือกหน่วยงาน',
                    'class' => 'form-control',
                    
                    
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
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
        //'filterModel'=>$searchModel,
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




