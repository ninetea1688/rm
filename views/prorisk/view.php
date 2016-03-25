<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Prorisk */

$this->title = $model->pro_risk_id;
$this->params['breadcrumbs'][] = ['label' => 'Prorisks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prorisk-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pro_risk_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pro_risk_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pro_risk_id',
            'pro_risk_name',
        ],
    ]) ?>

</div>
