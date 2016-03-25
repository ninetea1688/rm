<?php
use yii\helpers\Url;
?>
div class="row">
    <div class="col-md-4">

        <div class="panel panel-info">
            <div class="panel panel-heading ">รายงานประเภทบุคคล</div>
            <div class="panel panel-body">
                <ul class="list-group">
                    <li class="list-group-item"><a href="<?php echo Url::to(['report/userreport']);?>">ความเสี่ยงที่ตนเองเป็นผู้รายงาน</a></li>
                    <li class="list-group-item"><a href="">ความเสี่ยงที่บุคลากรในหน่วยงาน เป็นผู้รายงาน</a></li>
                    <li class="list-group-item"><a href="">ความเสี่ยงที่บุคลากรในทีม เป็นผู้รายงาน</a></li>
                </ul>
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="panel panel-warning">
            <div class="panel panel-heading ">รายงานสำหรับหน่วยงาน</div>
            <div class="panel panel-body">

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel panel-heading ">รายงานสำหรับทีมคล่อมสายงาน</div>
            <div class="panel panel-body">

            </div>
        </div>
    </div>

</div>