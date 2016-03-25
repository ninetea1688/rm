<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SeveritySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ระดับความรุนแรง');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="severity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <h4><span class="label label-warning">สามารถตั้งค่าการส่ง Email Notification ให้ได้ที่หน้าจอนี้</span></h4>
    </p>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'severity_id',
            'severity_text',
            'severity_name',
            //'severity_date',
            //'clinic_id',
            [   // แสดงข้อมูลออกเป็น icon
                'attribute' => 'mail_to_boss',
                'format' => 'html',
                'value' => function($model, $key, $index, $column) {
                    return $model->mail_to_boss == 'Y' ? "<i class=\"glyphicon glyphicon-ok\"></i>" : "<i class=\"glyphicon glyphicon-remove\"></i>";
                }],
            ['class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:120px;'],
                'buttonOptions' => ['class' => 'btn btn-info'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{update}</div>'
            ],
        ],
    ]); ?>

</div>
