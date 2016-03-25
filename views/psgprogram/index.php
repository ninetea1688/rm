<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PsgprogramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'โปรแกรมในกลุ่ม PSG';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psgprogram-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มโปรแกรมในกลุ่ม PSG', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php    Pjax::begin() ; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'psgp_id',
            [
                'attribute' => 'psg_id',
                'value' => 'psg.psgname',
            ],   
            //'psg.psgname',
            [
                'attribute' => 'pro_risk_id',
                'value' => 'prorisk.pro_risk_name',
            ],
            [
                'attribute' => 'pro_risk_detail_id',
                'value' => 'proriskdetail.pro_risk_detail_name',
            ],
            [
                'attribute' => 'pro_risk_sub_detail_id',
                'value' => 'prorisksubdetail.pro_risk_sub_detail_name',
            ],
            [
                'attribute' => 'incident_id',
                'value' => 'incident.incident_name',
            ],                        

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <?php Pjax::end() ; ?>

</div>
