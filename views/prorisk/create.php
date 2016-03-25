<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Prorisk */

$this->title = 'เพิ่มโปรแกรมความเสี่ยงหลัก';
$this->params['breadcrumbs'][] = ['label' => 'โปรแกรมความเสี่ยงหลัก', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prorisk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
