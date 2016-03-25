<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pro_risk_sub_detail".
 *
 * @property integer $pro_risk_sub_detail_id
 * @property integer $pro_risk_id
 * @property integer $pro_risk_detail_id
 * @property integer $pro_risk_sub_detail_key
 * @property string $pro_risk_sub_detail_name
 */
class Prorisksubdetail extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'pro_risk_sub_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['pro_risk_id', 'pro_risk_detail_id', 'pro_risk_sub_detail_key', 'pro_risk_sub_detail_name'], 'required'],
            [['pro_risk_id', 'pro_risk_detail_id', 'pro_risk_sub_detail_key'], 'integer'],
            [['pro_risk_sub_detail_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'pro_risk_sub_detail_id' => 'รหัสกระบวนการ',
            'pro_risk_id' => 'โปรแกรมความเสี่ยงหลัก',
            'pro_risk_detail_id' => 'โปรแกรมความเสี่ยงย่อย',
            'pro_risk_sub_detail_key' => 'Pro Risk Sub Detail Key',
            'pro_risk_sub_detail_name' => 'กระบวนการ',
        ];
    }

    public function getProrisk() {
        return @$this->hasOne(Prorisk::className(), ['pro_risk_id' => 'pro_risk_id']);
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

}
