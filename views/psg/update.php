<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Psg */

$this->title = 'แก้ไข PSG: ' . ' ' . $model->psg_id;
$this->params['breadcrumbs'][] = ['label' => 'PSG', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->psg_id, 'url' => ['view', 'id' => $model->psg_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="psg-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
