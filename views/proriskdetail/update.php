<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proriskdetail */

$this->title = 'แก้ไขโปรแกรมความเสี่ยงย่อย: ' . ' ' . $model->pro_risk_detail_id;
$this->params['breadcrumbs'][] = ['label' => 'Proriskdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pro_risk_detail_id, 'url' => ['view', 'id' => $model->pro_risk_detail_id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="proriskdetail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
