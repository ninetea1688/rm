<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Psgprogram */

$this->title = $model->psgp_id;
$this->params['breadcrumbs'][] = ['label' => 'Psgprograms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psgprogram-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('แก้ไขข้อมูล', ['update', 'id' => $model->psgp_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบข้อมูล', ['delete', 'id' => $model->psgp_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'คุณมั่นใจว่า ต้องการลบข้อมูลรายการนี้?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'psgp_id',
            'psg.psgname',
            'prorisk.pro_risk_name',
            'proriskdetail.pro_risk_detail_name',
            'prorisksubdetail.pro_risk_sub_detail_name',
            'incident.incident_name',
        ],
    ]) ?>

</div>
