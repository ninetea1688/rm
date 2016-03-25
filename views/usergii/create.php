<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usergii */

$this->title = 'Create Usergii';
$this->params['breadcrumbs'][] = ['label' => 'Usergiis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="usergii-create">
<?php echo Yii::$app->user->identity->username;?>
    <h1><?= Html::encode($this->title) ?></h1>
     

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
