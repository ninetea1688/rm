<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "psgprogram".
 *
 * @property integer $psgp_id
 * @property integer $psg_id
 * @property integer $pro_risk_id
 * @property integer $pro_risk_detail_id
 * @property integer $pro_risk_sub_detail_id
 * @property integer $incident_id
 */
class Psgprogram extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'psgprogram';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['psg_id', 'pro_risk_id', 'pro_risk_detail_id', 'pro_risk_sub_detail_id', 'incident_id'], 'required'],
            [['psg_id', 'pro_risk_id', 'pro_risk_detail_id', 'pro_risk_sub_detail_id', 'incident_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'psgp_id' => 'Psgp ID',
            'psg_id' => 'โปรแกรม PSG',
            'pro_risk_id' => 'โปรแกรมความเสี่ยงหลัก',
            'pro_risk_detail_id' => 'โปรแกรมความเสี่ยงย่อย',
            'pro_risk_sub_detail_id' => 'กระบวนการ',
            'incident_id' => 'อุบัติการ',
        ];
    }

    public function getPsg() {
        return @$this->hasOne(Psg::className(), ['psg_id' => 'psg_id']);
    }

    public function getProrisk() {
        return @$this->hasOne(Prorisk::className(), ['pro_risk_id' => 'pro_risk_id']);
    }

    public function getIncident() {
        return @$this->hasOne(Incident::className(), ['incident_id' => 'incident_id']);
    }

    public function getProriskdetail() {
        return @$this->hasOne(Proriskdetail::className(), ['pro_risk_detail_id' => 'pro_risk_detail_id']);
    }
    
    public function getProrisksubdetail() {
        return @$this->hasOne(Prorisksubdetail::className(), ['pro_risk_sub_detail_id' => 'pro_risk_sub_detail_id']);
    }

}
