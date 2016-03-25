<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Group;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Dep */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dep-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dep_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_id')->dropDownList(
                    ArrayHelper::map(Group::find()->all(), 'group_id', 'group_name'), ['prompt' => '--Select--']
            )
            ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
