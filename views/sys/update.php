<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sys */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sys',
]) . ' ' . $model->sys_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sys_id, 'url' => ['view', 'id' => $model->sys_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sys-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
