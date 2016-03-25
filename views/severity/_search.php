<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SeveritySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="severity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'severity_id') ?>

    <?= $form->field($model, 'severity_text') ?>

    <?= $form->field($model, 'severity_name') ?>

    <?= $form->field($model, 'severity_date') ?>

    <?= $form->field($model, 'clinic_id') ?>

    <?php // echo $form->field($model, 'mail_to_boss') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
