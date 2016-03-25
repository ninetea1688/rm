<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pro_risk_detail".
 *
 * @property integer $pro_risk_detail_id
 * @property integer $pro_risk_detail_key
 * @property string $pro_risk_detail_name
 * @property integer $pro_risk_id
 */
class Proriskdetail extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'pro_risk_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['pro_risk_detail_key', 'pro_risk_id'], 'integer'],
            [['pro_risk_detail_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'pro_risk_detail_id' => 'รหัสโปรแกรมความเสี่ยงย่อย',
            'pro_risk_detail_key' => 'Pro Risk Detail Key',
            'pro_risk_detail_name' => 'โปรแกรมความเสี่ยงย่อย',
            'pro_risk_id' => 'โปรแกรมความเสี่ยงหลัก',
        ];
    }

    public function getProrisk() {
        return @$this->hasOne(Prorisk::className(), ['pro_risk_id' => 'pro_risk_id']);
    }

    public function getProriskName() {
        return @$this->prorisk->pro_risk_name;
    }
}    