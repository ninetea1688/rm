<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Severity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="severity-form">

    <?php $form = ActiveForm::begin(); ?>
 
    <?= $form->field($model, 'mail_to_boss')->radioList(array(1=>'เปิดการใช้งาน',0=>'ปิดการใช้งาน')); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
