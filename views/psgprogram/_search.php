<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PsgprogramSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="psgprogram-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'psgp_id') ?>

    <?= $form->field($model, 'psg_id') ?>

    <?= $form->field($model, 'pro_risk_id') ?>

    <?= $form->field($model, 'pro_risk_detail_id') ?>

    <?= $form->field($model, 'pro_risk_sub_detail_id') ?>

    <?php // echo $form->field($model, 'incident_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
