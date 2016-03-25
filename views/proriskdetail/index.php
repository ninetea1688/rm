<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProriskdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'โปรแกรมความเสี่ยงย่อย';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proriskdetail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มโปรแกรมความเสี่ยงย่อย', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'pro_risk_detail_id',
            'prorisk.pro_risk_name',
            //'pro_risk_detail_key',
            'pro_risk_detail_name',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
