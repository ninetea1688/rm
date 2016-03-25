<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Risk */

$this->title = 'ศูนย์รับเรื่องทบทวนความเสี่ยง : ' . ' ' . $model->risk_id;
$this->params['breadcrumbs'][] = ['label' => 'Risks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->risk_id, 'url' => ['view', 'id' => $model->risk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="risk-update">

    <h1><?= 'ศูนย์รับเรื่องทบทวนความเสี่ยง' ?></h1>
    <?php
    //var_dump($model);
    //exit();
    ?>
    <?=
    $this->render('_formreceive', [
        'model' => $model,
    ])
    ?>

</div>
