<?php

use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop; //ทำdepan dropdown
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\helpers\Html;

use app\models\Clinic;
/* @var $this yii\web\View */
/* @var $model app\models\Severity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="severity-form">

    <?php $form = ActiveForm::begin(); ?>   
    
            <?=
            $form->field($model, 'clinic_id')->dropdownList(
                    ArrayHelper::map(Clinic::find()->all(), 'clinic_id', 'clinic_name'), [
                'id' => 'ddl-clinic',
                'prompt' => 'เลือกคลินิค'
                    ]
            );
            ?>
    
    <?= $form->field($model, 'severity_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'severity_text')->textInput(['maxlength' => true]) ?> 
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
