<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
?>
<div class="content-wrapper">


    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy;2015</strong> นายสุรชัย ศรีอาราม

</footer>

<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>
