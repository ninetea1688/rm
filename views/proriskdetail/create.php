<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Proriskdetail */

$this->title = 'เพิ่มโปรแกรมความเสี่ยงย่อย';
$this->params['breadcrumbs'][] = ['label' => 'Proriskdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proriskdetail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
