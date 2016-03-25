<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Prorisksubdetail */

$this->title = 'เพิ่มกระบวนการ';
$this->params['breadcrumbs'][] = ['label' => 'กระบวนการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prorisksubdetail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
