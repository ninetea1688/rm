<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dep */

$this->title = 'Update Dep: ' . ' ' . $model->dep_id;
$this->params['breadcrumbs'][] = ['label' => 'Deps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dep_id, 'url' => ['view', 'id' => $model->dep_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dep-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
