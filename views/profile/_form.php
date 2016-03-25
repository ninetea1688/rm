<?php

use yii\widgets\ActiveForm;
use app\models\Dep;
use app\models\Team;
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
        <div class="col-md-4 ">
            <?=
            
    $form->field($model, 'dep_id')->dropDownList(
            ArrayHelper::map(Dep::find()->all(),'dep_id', 'dep_name'), ['prompt' => '--Select--']
              
    )
    ?>
        </div>
        <div class="col-md-4 ">
            <?=
            
    $form->field($model, 'team_id')->dropDownList(
            ArrayHelper::map(Team::find()->all(),'team_id', 'team_name'), ['prompt' => '--Select--']
              
    )
    ?>
        </div>
    </div>
    <div class="row">
        
    </div>
    <?= $form->field($model, 'bio')->textarea(['rows' => 6]) ?>


    <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
