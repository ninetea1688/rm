<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop; //ทำdepan dropdown
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Prorisk;

/* @var $this yii\web\View */
/* @var $model app\models\Proriskdetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proriskdetail-form">

    <?php $form = ActiveForm::begin(); ?>    

    <?=
    $form->field($model, 'pro_risk_id')->dropdownList(
            ArrayHelper::map(Prorisk::find()->all(), 'pro_risk_id', 'pro_risk_name'), [
        'id' => 'ddl-prorisk',
        'prompt' => 'เลือกโปรแกรมความเสี่ยง'
    ]);
    ?>

    <?= $form->field($model, 'pro_risk_detail_name')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'เพิ่มข้อมูล' : 'แก้ไขข้อมูล', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
