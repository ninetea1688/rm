<html lang="en">
    <head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    </head>
    <?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use app\models\Team;
use app\models\Level;
use yii\web\Session;
use app\models\Profile;


$this->title = 'Risks';
//$this->params['breadcrumbs'][] = $this->title;
@$uname=Yii::$app->user->identity->username;
$uid = Yii::$app->user->identity->id;
$gp = Profile::findOne(['user_id' => $uid]) ;
$session = Yii::$app->session;

        //$t = $session['team_id'];
        $t = $gp->team_id;
        $tn= Team::findOne(['team_id'=>$t]);
        $l = $gp->level_id;
        //$l=$session['level_id'];
        $ln=  Level::findOne(['level_id'=>$l]);
 ?>
    <div class="page-header">
        <h3> ความเสี่ยงทั้งหมด ของทีม <?php echo $tn->team_name;?></h3>
        <h4><div class="label label-danger">เข้าดูในฐานะ<?php echo $ln->level_name;?></div></h4>


   </div>

<div class="risk-index col-md-12">

    <?php echo ExportMenu::widget(['dataProvider' => $dataProvider]);?>

    <div class="col-md-12 ">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'risk_id',
            'date_stamp',
            'teamname',
            'proriskname',
            'proriskdetailname',
            'prorisksubdetailname',
            [ // แสดงข้อมูลออกเป็นสีตามเงื่อนไข
          'attribute' => 'follow_id',
          'format'=>'html',
          'value'=>function($model){
            return $model->follow_id==1 ? "<span style=\"color:green;\">แก้ไขแล้ว</span>":"<span style=\"color:red;\">ยังไม่ได้แก้ไข</span>";
          }
        ],
            ['class' => 'yii\grid\ActionColumn',
                'options'=>['style'=>'width:120px;'],
            'buttonOptions'=>['class'=>'btn btn-info'],
            'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view} {update} {delete} </div>'
                ],
        ],
    ]); ?>
</div>


</div>
</html>
