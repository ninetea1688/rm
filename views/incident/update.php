<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Incident */

$this->title = 'Update Incident: ' . ' ' . $model->incident_id;
$this->params['breadcrumbs'][] = ['label' => 'Incidents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->incident_id, 'url' => ['view', 'id' => $model->incident_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="incident-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
