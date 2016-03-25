<?php

use yii\widgets\ActiveForm;
use app\models\Dep;
use app\models\Level;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    
    <?php $form = ActiveForm::begin(); ?>
    
<div class="row">
        <div class="col-md-4">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
</div>
    <div class="row">
        <div class="col-md-12 ">
            <?=
            
    $form->field($model, 'dep_list_id')->checkboxList(
            ArrayHelper::map(Dep::find()->all(),'dep_id', 'dep_name')
              
    )
    ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?=
            $form->field($model, 'level_id')->dropDownList(
                    ArrayHelper::map(Level::find()->all(), 'level_id', 'level_name'), ['prompt' => '--ระดับสิทธิ--']
            )
            ?>
        </div>
    </div>
    <?= $form->field($model, 'bio')->textarea(['rows' => 6]) ?>


    <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
