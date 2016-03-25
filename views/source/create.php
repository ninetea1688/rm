<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Source */

$this->title = Yii::t('app', 'Create Source');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sources'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
