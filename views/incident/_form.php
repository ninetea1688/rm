<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop; //ทำdepan dropdown
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;

use app\models\Prorisk;
use app\models\Proriskdetail;
use app\models\Prorisksubdetail;

/* @var $this yii\web\View */
/* @var $model app\models\Incident */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incident-form">

    <?php $form = ActiveForm::begin(); ?>

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


    <?= $form->field($model, 'incident_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
