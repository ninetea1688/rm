<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;



///// กล่องแรก
$noti1 = [];
        $noti2 = [];
        $noti3 = [];
        $c = Yii::$app->db->createCommand("SELECT
COUNT(*) AS total,
SUM(CASE WHEN (follow_id <>1 or follow_id is NULL) THEN 1 ELSE 0 END) as un
,SUM(CASE WHEN date_stamp=DATE(now()) THEN 1 ELSE 0 END) as date
 FROM risk ");
        $q = $c->queryAll();
        foreach ($q as $a) {
            array_push($noti1, intval($a['total']));
            array_push($noti2, intval($a['un']));
            array_push($noti3, intval($a['date']));
        }


?>

<header class="main-header">

   <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', '', ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- แจ้งเตือน-->
                <!--
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        
                        <i class="fa fa-list-ol"></i>
                        <span class="label label-success"><?=$noti1[0];?></span>
                    </a>
                </li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                       
                        <i class="fa fa-calendar"></i>
                        <span class="label label-info"><?=$noti3[0];?></span>
                    </a>
                  
                </li>
                
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      
                        <i class="fa fa-exclamation-triangle"></i>
                        <span class="label label-danger"><?=$noti2[0];?></span>
                    </a>
                </li>
                
                -->
                <!-- End แจ้งเตือน -->


<!--                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            -->
      
            
            </ul>
        </div>
    </nav>
</header>
