<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JsExpression;
use miloschuman\highcharts\Highcharts;
use rmrevin\yii\fontawesome\FA;
rmrevin\yii\fontawesome\AssetBundle::register($this);
//print_r($events);
//return;
?>

    <div class="col-md-6 col-md-offset-1">
        <?=
        \yii2fullcalendar\yii2fullcalendar::widget(array(
            'events' => $events,
        ));
        ?>
    </div>
</div>