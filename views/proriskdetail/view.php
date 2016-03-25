<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Proriskdetail */

$this->title = $model->pro_risk_detail_id;
$this->params['breadcrumbs'][] = ['label' => 'โปรแกรมความเสี่ยงย่อย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proriskdetail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('แก้ไขข้อมูล', ['update', 'id' => $model->pro_risk_detail_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบข้อมูล', ['delete', 'id' => $model->pro_risk_detail_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'คุณมั่นใจว่าจะลบข้อมูลรายการนี้ ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pro_risk_detail_id',
            //'pro_risk_detail_key',
            'prorisk.pro_risk_name',
            'pro_risk_detail_name',
            
        ],
    ]) ?>

</div>
