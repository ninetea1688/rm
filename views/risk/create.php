<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Risk */

$this->title = 'รายงานความเสี่ยง';
$this->params['breadcrumbs'][] = ['label' => 'Risks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_insertrisk', [
        'model' => $model,
    ]) ?>

</div>
