<html lang="en">
    <head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    </head>
    <?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RiskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Risks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-index col-md-12">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Risk', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="col-md-10 col-md-offset-1 ">
       
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'risk_id',
            'date_stamp',
            'pro_risk_name',
            'pro_risk_detail_id',
            'pro_risk_sub_detail_id',
            // 'clinic_id',
            // 'severity_level',
            // 'date_risk',
            // 'born_id',
            // 'source_id',
            // 'detail_prob',
            // 'edit_dep_id',
            // 'edit_user_id',
            // 'date_edit',
            // 'method',
            // 'review_id',
            // 'review_date',
            // 'review_detail',
            // 'follow_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
   

</div>
</html>