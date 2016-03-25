<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop; //ทำdepan dropdown
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use kartik\date\DatePicker;

//////models
use app\models\Prorisk;
use app\models\Proriskdetail;
use app\models\Prorisksubdetail;
use app\models\Clinic;
use app\models\Severity;
use app\models\Born;
use app\models\Source;
use app\models\Dep;
use app\models\Team;

?>
<?php $form = ActiveForm::begin(); ?>
<div class="panel-body">
    <div class="panel panel-primary">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-plus"></i> แบบรายงานความเสี่ยง Incident Report
            </h4></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-user"></i> ส่วนรายงานเหตุการณ์
                            </h5></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <?= $form->field($model, 'date_stamp')->textInput(array('value' => date("Y-m-d"), 'readOnly' => true)) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'incident_detail')->textarea(['maxlength' => true], 'required') ?>
                                </div>
                            </div>
                            <div class="row">
                                <?= $form->field($model, 'user_id')->hiddenInput(array('value' => Yii::$app->user->identity->id)) ?>
                                <!------------------------------------------------------------->
                                <div class="col-md-4">
                                    <?=
                                    $form->field($model, 'pro_risk_id')->dropdownList(
                                        ArrayHelper::map(Prorisk::find()->all(), 'pro_risk_id', 'pro_risk_name'), [
                                        'id' => 'ddl-prorisk',
                                        'prompt' => 'เลือกโปรแกรมความเสี่ยง'
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?php
                                    if($model->isNewRecord){
                                        $r1 = [];
                                    }else{
                                        if(isset($model->pro_risk_detail_id)){
                                            $r1 = [$model->pro_risk_detail_id => $model->proriskdetail->pro_risk_detail_name];
                                        }else{
                                            $r1 = [];
                                        }
                                    }
                                    ?>
                                    <?=
                                    $form->field($model, 'pro_risk_detail_id')->widget(DepDrop::classname(), [
                                        'options' => ['id' => 'ddl-proriskdetail'],
                                        //'data' => $model->isNewRecord ? [] : [$model->pro_risk_detail_id => $model->proriskdetail->pro_risk_detail_name],
                                        'data' => $r1,
                                        'pluginOptions' => [
                                            'depends' => ['ddl-prorisk'],
                                            'placeholder' => 'เลือก...',
                                            'required' => true,
                                            'url' => Url::to(['/risk/get-proriskdetail'])
                                        ]
                                    ]);
                                    ?>
                                </div>

                                <div class="col-md-4">
                                    <?php
                                    if($model->isNewRecord){
                                        $r2 = [];
                                    }else{
                                        if(isset($model->pro_risk_sub_detail_id)){
                                            $r2 = [$model->pro_risk_sub_detail_id => $model->prorisksubdetail->pro_risk_sub_detail_name];
                                        }else{
                                            $r2 = [];
                                        }
                                    }
                                    ?>
                                    <?=
                                    $form->field($model, 'pro_risk_sub_detail_id')->widget(DepDrop::classname(), [
                                        'options' => ['id' => 'ddl-prorisksubdetail'],
                                        //'data' => $model->isNewRecord ? [] : [$model->pro_risk_sub_detail_id => $model->prorisksubdetail->pro_risk_sub_detail_name],
                                        'data' => $r2,
                                        'pluginOptions' => [
                                            'depends' => ['ddl-proriskdetail'],
                                            'placeholder' => 'เลือก...',
                                            'url' => Url::to(['/risk/get-prorisksubdetail'])
                                        ]
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <?php
                                        if($model->isNewRecord){
                                            $r3 = [];
                                        }else{
                                            if(isset($model->incident_id)){
                                                $r3 = [$model->incident_id => $model->incident->incident_name];
                                            }else{
                                                $r3 = [];
                                            }
                                        }
                                    ?>
                                    <?=
                                    $form->field($model, 'incident_id')->widget(DepDrop::classname(), [
                                        'options' => ['id' => 'ddl-incident'],
                                        //'data' => $model->isNewRecord ? [] : [$model->incident_id => $model->incident->incident_name],
                                        'data' => $r3,
                                        'pluginOptions' => [
                                            'depends' => ['ddl-prorisksubdetail'],
                                            'placeholder' => 'เลือก...',
                                            'url' => Url::to(['/risk/get-incident'])
                                        ]
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($model, 'clinic_id')->dropdownList(
                                        ArrayHelper::map(Clinic::find()->all(), 'clinic_id', 'clinic_name'), [
                                            'id' => 'ddl-clinic',
                                            'prompt' => 'เลือกคลินิค'
                                        ]
                                    );
                                    ?>
                                </div>
                                <!----------------------------------------------------->
                                <div class="col-md-4">
                                    <?php
                                    if($model->isNewRecord){
                                        $r4 = [];
                                    }else{
                                        if(isset($model->severity_level)){
                                            //var_dump($model->severity_level);
                                            //exit();
                                            $r4 = [$model->severity_level => $model->severity->severity_name];
                                        }else{
                                            $r4 = [];
                                        }
                                    }
                                    ?>
                                    <?=
                                    $form->field($model, 'severity_level')->widget(DepDrop::classname(), [
                                        'options' => ['id' => 'ddl-severity'],
                                        //'data' => $model->isNewRecord ? [] : [$model->severity_level => $model->severity->severity_name],
                                        'data' => $r4,
                                        'pluginOptions' => [
                                            'depends' => ['ddl-clinic'],
                                            'placeholder' => 'เลือก...',
                                            'url' => Url::to(['/risk/get-severity'])
                                        ]
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                        <?= $form->field($model, 'date_risk')->widget(
                                            DatePicker::className(),[
                                                'pluginOptions' => [
                                                    'autoclose' => true,
                                                    'format' =>'yyyy-mm-dd'
                                                ]
                                            ]
                                        )
                                        ?>
                                    </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($model, 'born_id')->dropDownList(
                                        ArrayHelper::map(Born::find()->all(), 'born_id', 'born_name'), ['prompt' => 'เลือกลักษณะการเกิด']
                                    )
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($model, 'source_id')->dropDownList(
                                        ArrayHelper::map(Source::find()->all(), 'source_id', 'source_name'), ['prompt' => 'เลือกแหล่งที่มาของข้อมุล']
                                    )
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'detail_prob')->textarea(['maxlength' => true], 'required') ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <?=
                                    $form->field($model, 'dep_id')->dropDownList(
                                        ArrayHelper::map(Dep::find()->all(), 'dep_id', 'dep_name'), ['prompt' => 'เลือกหน่วยงานที่รายงาน']
                                    )
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($model, 'team_id')->dropDownList(
                                        ArrayHelper::map(Team::find()->all(), 'team_id', 'team_name'), ['prompt' => 'เลือกทีมคล่อมสายงานที่เกิดความเสี่ยง']
                                    )
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?= $form->field($model, 'num')->input('text', ['required', 'value' => 1]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <center>
                            <div class="form-group">
                                <?= Html::submitButton($model->isNewRecord ? 'บันทึกข้อมูล' : 'แก้ไขข้อมูล', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg btn-block glyphicon glyphicon-floppy-save' : 'btn btn-success btn-lg btn-block glyphicon glyphicon-floppy-save']) ?>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
