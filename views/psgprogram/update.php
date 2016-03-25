<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Psgprogram */

$this->title = 'Update Psgprogram: ' . ' ' . $model->psgp_id;
$this->params['breadcrumbs'][] = ['label' => 'Psgprograms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->psgp_id, 'url' => ['view', 'id' => $model->psgp_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="psgprogram-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
