<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Incident */

$this->title = $model->incident_id;
$this->params['breadcrumbs'][] = ['label' => 'อุบัติการณ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incident-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('แก้ไขข้อมูล', ['update', 'id' => $model->incident_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบข้อมูล', ['delete', 'id' => $model->incident_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'คุณมันใจว่าจะลบข้อมูลรายการนี้ ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'incident_id',
            'prorisk.pro_risk_name',
            'proriskdetail.pro_risk_detail_name',
            'prorisksubdetail.pro_risk_sub_detail_name',
            'incident_name',
        ],
    ]) ?>

</div>
