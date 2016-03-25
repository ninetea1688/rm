<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProriskdetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proriskdetail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pro_risk_detail_id') ?>

    <?= $form->field($model, 'pro_risk_detail_key') ?>

    <?= $form->field($model, 'pro_risk_detail_name') ?>

    <?= $form->field($model, 'pro_risk_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
