<?php

namespace app\models;

use app\models\Prorisk;
use app\models\Proriskdetail;
use app\models\Prorisksubdetail;
use app\models\Incident;
use app\models\Clinic;
use app\models\Born;
use app\models\Source;
use app\models\Dep;
use app\models\Team;
use Yii;

class Risk extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'risk';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['date_stamp', 'date_risk', 'incident_detail', 'detail_prob'], 'required'],
            [['date_risk', 'date_edit', 'review_date', 'severity_level' , 'date_edit'
                , 'review_date', 'severity_level', 'pro_risk_id'
                , 'clinic_id', 'born_id', 'source_id', 'dep_id','team_id'
                , 'edit_dep_id', 'user_id', 'edit_user_id'
                ,'num'], 'safe'],
            [['pro_risk_id', 'pro_risk_detail_id', 'pro_risk_sub_detail_id', 'incident_id', 'clinic_id', 'born_id', 'source_id', 'dep_id', 'team_id', 'edit_dep_id', 'edit_team_id', 'user_id', 'edit_user_id', 'review_id', 'follow_id', 'num'], 'integer'],
            [['detail_prob', 'method', 'review_detail'], 'string', 'max' => 255]
        ];
    }

/*
    public function scenarios() {

        $scenarios = parent::scenarios();

        $scenarios['regist'] = ['user_id','date_stamp','pro_risk_id', 'pro_risk_detail_id', 
            'pro_risk_sub_detail_id', 'clinic_id', 'incident_detail', 'severity_level', 'date_risk', 'born_id',
            'source_id', 'detail_prob', 'dep_id','team_id','num'];
        $scenarios['report'] = ['date_edit','edit_dep_id','edit_team_id','edit_user_id',
            'detail_prob',
            'method','review_id','review_date','review_detail','follow_id'];
        return $scenarios;
    }
*/
    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'risk_id' => 'Risk ID',
            'incident_detail' => 'รายละเอียดเหตุการณ์',
            'date_stamp' => 'วันที่บันทึกข้อมูล',
            'pro_risk_id' => 'โปรแกรมความเสียงหลัก',
            'pro_risk_detail_id' => 'โปรแกรมความเสี่ยงย่อย',
            'pro_risk_sub_detail_id' => 'กระบวนการ',
            'incident_id' => 'อุบัติการ',
            'clinic_id' => 'ประเถทของคลินิค',
            'severity_level' => 'ระดับความรุนแรง',
            'date_risk' => 'วันที่เกิดความเสี่ยง',
            'born_id' => 'ลักษณะการเกิด',
            'source_id' => 'แหล่งที่ทำให้ทราบถึงความเสี่ยง',
            'detail_prob' => 'รายละเอียดการแก้ปัญหาเบื้องต้น',
            'user_id' => '',
            'dep_id' => 'หน่วยงานที่เกิดความเสี่ยง',
            'team_id' => 'ที่มคล่อมสายงานที่เกิดความเสี่ยง',
            'num' => 'จำนวนครั้งที่เกิดความเสี่ยงต่อการรายงาน',
            'edit_dep_id' => 'หน่วยงานที่เกิดความเสี่ยง',
            'edit_team_id' => 'ทีมคล่อมสายงานที่รายงานความเสี่ยง',
            'edit_user_id' => '',
            'date_edit' => 'วันที่รับเรื่องความเสี่ยง',
            'method' => 'การจัดการระดับหน่วยงาน / ระบบใหม่ที่เกิดขึ้น',
            'review_id' => 'ประเภทการทบทวน',
            'review_date' => 'วันที่ศูนย์ได้รับการทบทวน',
            'review_detail' => 'ผลการทบทวน',
            'follow_id' => 'ประเภทการติดตาม',
            ////relation////
            'proriskname' => 'โปรแกรมความหลัก',
            'proriskdetailname' => 'โปรแกรมความเสี่ยงย่อย',
            'prorisksubdetailname' => 'กระบวนการ',
            'clinicname' => 'ประเภทคลินิค',
            'bornname' => 'ลักษณะการเกิด',
            'sourcename' => 'แหล่งที่มาของข้อมูล',
            'depname' => 'หน่วยงานที่เกิดความเสี่ยง',
            'editdepname' => 'หน่วยงานที่เกิดความเสี่ยง',
            'teamname' => 'ทีมคล่อมสายงานที่เกิดความเสี่ยง',
            'editteamname' => 'ทีมคล่อมสายงานที่แก้ไขความเสี่ยง',
            'followname' => 'ประเภทการติดตาม',
            'reviewname' => 'ประเภทการทบทวน'
        ];
    }

    public function getProrisk() {
        return @$this->hasOne(Prorisk::className(), ['pro_risk_id' => 'pro_risk_id']);
    }
    
    public function getIncident(){
        return @$this->hasOne(Incident::className(), ['incident_id' => 'incident_id']) ;
    }

    public function getProriskName() {
        return @$this->prorisk->pro_risk_name;
    }

    public function getProriskdetail() {
        return @$this->hasOne(Proriskdetail::className(), ['pro_risk_detail_id' => 'pro_risk_detail_id']);
    }

    public function getProriskdetailName() {
        return @$this->proriskdetail->pro_risk_detail_name;
    }

    public function getProrisksubdetail() {
        return @$this->hasOne(Prorisksubdetail::className(), ['pro_risk_sub_detail_id' => 'pro_risk_sub_detail_id']);
    }

    public function getProrisksubdetailName() {
        return @$this->prorisksubdetail->pro_risk_sub_detail_name;
    }

    public function getClinic() {
        return @$this->hasOne(Clinic::className(), ['clinic_id' => 'clinic_id']);
    }

    public function getClinicName() {
        return @$this->clinic->clinic_name;
    }

    public function getSeverity(){
        return $this->hasOne(Severity::className(),['severity_text' => 'severity_level']);
    }

    public function getBorn() {
        return @$this->hasOne(Born::className(), ['born_id' => 'born_id']);
    }

    public function getBornName() {
        return @$this->born->born_name;
    }

    public function getSource() {
        return @$this->hasOne(Source::className(), ['source_id' => 'source_id']);
    }

    public function getSourceName() {
        return @$this->source->source_name;
    }

    public function getDep() {
        return @$this->hasOne(Dep::className(), ['dep_id' => 'dep_id']);
    }

    public function getDepName() {
        return @$this->dep->dep_name;
    }

    public function getEditdep() {
        return @$this->hasOne(Dep::className(), ['dep_id' => 'edit_dep_id']);
    }

    public function getEditdepName() {
        return @$this->editdep->dep_name;
    }

    public function getTeam() {
        return @$this->hasOne(Team::className(), ['team_id' => 'team_id']);
    }

    public function getTeamName() {
        return @$this->team->team_name;
    }

    public function getEditteam() {
        return @$this->hasOne(Team::className(), ['team_id' => 'edit_team_id']);
    }

    public function getEditteamName() {
        return @$this->editteam->team_name;
    }

    public function getFollow() {
        return @$this->hasOne(Follow::className(), ['follow_id' => 'follow_id']);
    }

    public function getFollowName() {
        return @$this->follow->follow_name;
    }

    public function getReview() {
        return @$this->hasOne(Review::className(), ['review_id' => 'review_id']);
    }

    public function getReviewName() {
        return @$this->review->review_name;
    }

}
