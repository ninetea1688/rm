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
use app\models\Clinic;
use app\models\Severity;

?>

<div class="risk-form form-inline col-md-10 col-md-offset-1">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_stamp')->textInput(array('value' => date("Y-m-d"))) ?>
    <!------------------------------------------------------------->
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
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-prorisk'],
            'placeholder' => 'เลือก...',
            'url' => Url::to(['/risk/get-proriskdetail'])
        ]
            
    ]);
    ?>
    <?=
    $form->field($model, 'pro_risk_sub_detail_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-prorisksubdetail'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-proriskdetail'],
            'placeholder' => 'เลือก...',
            'url' => Url::to(['/risk/get-prorisksubdetail'])
        ]
    ]);
    ?>
    <?=
    $form->field($model, 'clinic_id')->dropdownList(
            ArrayHelper::map(Clinic::find()->all(), 'clinic_id', 'clinic_name'), [
        'id' => 'ddl-clinic',
        'prompt' => 'เลือกคลินิค'
            ]
            );
    ?>
    <!----------------------------------------------------->
<?=
    $form->field($model, 'severity_level')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-severity'],
        'data' => [],
        'pluginOptions' => [
            'depends' => ['ddl-clinic'],
            'placeholder' => 'เลือก...',
            'url' => Url::to(['/risk/get-severity'])
        ]
    ]);
    ?>

  

    <?= $form->field($model, 'date_risk')->input('date', ['required']) ?>

    <?= $form->field($model, 'born_id')->textInput() ?>

    <?= $form->field($model, 'source_id')->textInput() ?>

    <?= $form->field($model, 'detail_prob')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edit_dep_id')->textInput() ?>

    <?= $form->field($model, 'edit_user_id')->textInput() ?>

    <?= $form->field($model, 'date_edit')->textInput() ?>

    <?= $form->field($model, 'method')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'review_id')->textInput() ?>

    <?= $form->field($model, 'review_date')->textInput() ?>

    <?= $form->field($model, 'review_detail')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'follow_id')->textInput() ?>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
