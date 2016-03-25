<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Psg */

$this->title = 'เพิ่มโปรแกรม PSG';
$this->params['breadcrumbs'][] = ['label' => 'PSG', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
