<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "severity".
 *
 * @property integer $severity_id
 * @property string $severity_text
 * @property string $severity_name
 * @property integer $severity_date
 * @property integer $clinic_id
 */
class Severity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'severity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['severity_text'], 'required'],
            [['severity_date', 'clinic_id','mail_to_boss'], 'integer'],
            [['severity_text'], 'string', 'max' => 2],
            [['severity_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'severity_id' => 'Severity ID',
            'severity_text' => 'Severity Text',
            'severity_name' => 'Severity Name',
            'severity_date' => 'Severity Date',
            'clinic_id' => 'Clinic ID',
            'mail_to_boss'=>'Mail to Boss',
        ];
    }
}
