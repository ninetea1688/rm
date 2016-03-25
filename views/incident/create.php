<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Incident */

$this->title = 'เพิ่มอุบัติการณ์';
$this->params['breadcrumbs'][] = ['label' => 'อุบัติการณ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incident-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
