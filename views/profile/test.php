<?php

use yii\helpers\Html;

//use yii\db\Query;
//if(Yii::$app->user->identity->id)
$i=Yii::$app->user->identity->id;

echo $i;
$connection = \Yii::$app->db;
$model = $connection->createCommand('select name from profile where user_id='.$i.'');
$users = $model->queryColumn();
echo $users[0];