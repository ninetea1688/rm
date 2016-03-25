<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $model app\models\Risk */

$this->title = $model->risk_id;
$this->params['breadcrumbs'][] = ['label' => 'Risks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
 ?>
<div class="risk-view">

    <h1><?= Html::encode($this->title) ?></h1>
<?php //echo ExportMenu::widget(['dataProvider' => $model]);?>
    <p>
        <?= Html::a('Update', ['receive', 'id' => $model->risk_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->risk_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'risk_id',
            'date_stamp',
            'incident_detail',
            'proriskname',
            //'pro_risk_id',
            //'pro_risk_detail_id',
            'proriskdetailname',
            'prorisksubdetailname',
            'incident.incident_name',
            //'pro_risk_sub_detail_id',
            //'clinic_id',
            'clinicname',
            'severity_level',
            'date_risk',
            'bornname',
            //'born_id',
            'sourcename',
            //'source_id',
            'detail_prob',
            'depname',
            'teamname',
            'num',
            'editdepname',
            'editteamname',
            'date_edit',
            'method',
            'reviewname',
            'review_date',
            'review_detail',
            'followname',
        ],
    ])
    ?>

</div>
