<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Psg */

$this->title = $model->psg_id;
$this->params['breadcrumbs'][] = ['label' => 'Psgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psg-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('แก้ไขข้อมูล', ['update', 'id' => $model->psg_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบข้อมูล', ['delete', 'id' => $model->psg_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'คุณมั่นใจว่าต้องการลบข้อมูล รายการนี้ ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'psg_id',
            'psgname',
        ],
    ]) ?>

</div>
