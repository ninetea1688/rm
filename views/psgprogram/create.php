<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Psgprogram */

$this->title = 'เพิ่มอุบัติการณ์ในโปรแกรม PSG';
$this->params['breadcrumbs'][] = ['label' => 'เพิ่มอุบัติการณ์ในโปรแกรม PSG', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psgprogram-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
