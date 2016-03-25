<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RiskSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="risk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'incident_detail') ?>

    <?= $form->field($model, 'pro_risk_id') ?>

    <?= $form->field($model, 'pro_risk_detail_id') ?>

    <?= $form->field($model, 'pro_risk_sub_detail_id') ?>

    <?= $form->field($model, 'incident_id') ?>

    <?php // echo $form->field($model, 'clinic_id') ?>

    <?php // echo $form->field($model, 'severity_level') ?>

    <?php // echo $form->field($model, 'date_risk') ?>

    <?php // echo $form->field($model, 'born_id') ?>

    <?php // echo $form->field($model, 'source_id') ?>

    <?php // echo $form->field($model, 'detail_prob') ?>

    <?php // echo $form->field($model, 'edit_dep_id') ?>

    <?php // echo $form->field($model, 'edit_user_id') ?>

    <?php // echo $form->field($model, 'date_edit') ?>

    <?php // echo $form->field($model, 'method') ?>

    <?php // echo $form->field($model, 'review_id') ?>

    <?php // echo $form->field($model, 'review_date') ?>

    <?php // echo $form->field($model, 'review_detail') ?>

    <?php // echo $form->field($model, 'follow_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
