<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Severity */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Severity',
]) . ' ' . $model->severity_text.' '. $model->severity_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Severities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->severity_id, 'url' => ['view', 'id' => $model->severity_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="severity-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_formold', [
        'model' => $model,
    ]) ?>

</div>
