<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clinic".
 *
 * @property integer $clinic_id
 * @property string $clinic_name
 */
class Clinic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clinic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clinic_id'], 'required'],
            [['clinic_id'], 'integer'],
            [['clinic_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'clinic_id' => 'Clinic ID',
            'clinic_name' => 'Clinic Name',
        ];
    }
}
