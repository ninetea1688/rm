<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IncidentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incident-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'incident_id') ?>

    <?= $form->field($model, 'pro_risk_id') ?>

    <?= $form->field($model, 'pro_risk_detail_id') ?>

    <?= $form->field($model, 'pro_risk_sub_detail_id') ?>

    <?= $form->field($model, 'incident_name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
