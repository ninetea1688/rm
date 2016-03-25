<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop; //ทำdepan dropdown
use yii\helpers\Url;
use yii\helpers\VarDumper;
use app\models\Prorisk;
use app\models\Psg;

/* @var $this yii\web\View */
/* @var $model app\models\Psgprogram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="psgprogram-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'psg_id')->dropdownList(
            ArrayHelper::map(Psg::find()->all(), 'psg_id', 'psgname'), [
        'id' => 'ddl-psg',
        'prompt' => 'เลือกโปรแกรม PSG'
    ]);
    ?>

    <?=
    $form->field($model, 'pro_risk_id')->dropdownList(
            ArrayHelper::map(Prorisk::find()->all(), 'pro_risk_id', 'pro_risk_name'), [
        'id' => 'ddl-prorisk',
        'prompt' => 'เลือกโปรแกรมความเสี่ยง'
    ]);
    ?>

    <?=
    $form->field($model, 'pro_risk_detail_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-proriskdetail'],
        'data' => $model->isNewRecord ? [] : [$model->pro_risk_detail_id => $model->proriskdetail->pro_risk_detail_name],
        'pluginOptions' => [
            'depends' => ['ddl-prorisk'],
            'placeholder' => 'เลือก...',
            'required' => true,
            'url' => Url::to(['/risk/get-proriskdetail'])
        ]
    ]);
    ?>

    <?=
    $form->field($model, 'pro_risk_sub_detail_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-prorisksubdetail'],
        'data' => $model->isNewRecord ? [] : [$model->pro_risk_sub_detail_id => $model->prorisksubdetail->pro_risk_sub_detail_name],
        'pluginOptions' => [
            'depends' => ['ddl-proriskdetail'],
            'placeholder' => 'เลือก...',
            'url' => Url::to(['/risk/get-prorisksubdetail'])
        ]
    ]);
    ?>



    <?=
    $form->field($model, 'incident_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-incident'],
        'data' => $model->isNewRecord ? [] : [$model->incident_id => $model->incident->incident_name],
        'pluginOptions' => [
            'depends' => ['ddl-prorisksubdetail'],
            'placeholder' => 'เลือก...',
            'url' => Url::to(['/risk/get-incident'])
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'เพิ่มข้อมูล' : 'แก้ไขข้อมูล', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
