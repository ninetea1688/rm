<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pro_risk".
 *
 * @property integer $pro_risk_id
 * @property string $pro_risk_name
 */
class Prorisk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pro_risk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_risk_id'], 'required'],
            [['pro_risk_id'], 'integer'],
            [['pro_risk_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pro_risk_id' => 'รหัส',
            'pro_risk_name' => 'โปรแกรมความเสี่ยงหลัก',
        ];
    }
}
