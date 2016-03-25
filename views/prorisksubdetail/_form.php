<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop; //ทำdepan dropdown
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;


use app\models\Prorisk;
use app\models\Proriskdetail;
use app\models\Risk;
use app\controllers\RiskController;

/* @var $this yii\web\View */
/* @var $model app\models\Prorisksubdetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prorisksubdetail-form">

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
    //'data' => [$model->pro_risk_detail_id => $model->proriskdetail->pro_risk_detail_name],
    'data' => $model->isNewRecord ? [] : [$model->pro_risk_detail_id => $model->proriskdetail->pro_risk_detail_name],
    //'data'=> [9=>'Savings'],
    'pluginOptions' => [
        'depends' => ['ddl-prorisk'],
        'placeholder' => 'เลือก...',
        'required' => true,
        'url' => Url::to(['/prorisksubdetail/get-proriskdetail'])
    ]
]);
?>
    <?= $form->field($model, 'pro_risk_sub_detail_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'เพิ่มข้อมูล' : 'แก้ไขข้อมูล', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
