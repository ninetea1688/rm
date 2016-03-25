<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProrisksubdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'กระบวนการ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prorisksubdetail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มกระบวนการ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php    Pjax::begin() ; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
            'pro_risk_sub_detail_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end() ; ?>
</div>
