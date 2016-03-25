<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prorisksubdetail */

$this->title = 'แก้ไข กระบวนการ : ' . ' ' . $model->pro_risk_sub_detail_id;
$this->params['breadcrumbs'][] = ['label' => 'Prorisksubdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pro_risk_sub_detail_id, 'url' => ['view', 'id' => $model->pro_risk_sub_detail_id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="prorisksubdetail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
