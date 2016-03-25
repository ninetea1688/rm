<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ตั้งค่าโปรแกรม');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'sys_id',
            'sys_name',
            //'sys_status',
            [   // แสดงข้อมูลออกเป็น icon
                'attribute' => 'sys_status',
                'format' => 'html',
                'value' => function($model, $key, $index, $column) {
                    return $model->sys_status == '1' ? "<i class=\"glyphicon glyphicon-ok\"></i>" : "<i class=\"glyphicon glyphicon-remove\"></i>";
                }],
            ['class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:120px;'],
                'buttonOptions' => ['class' => 'btn btn-info'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{update}</div>'
            ],
        ],
    ]);
    ?>

</div>
