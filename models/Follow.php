<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "follow".
 *
 * @property integer $follow_id
 * @property string $follow_name
 */
class Follow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'follow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['follow_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'follow_id' => 'Follow ID',
            'follow_name' => 'Follow Name',
        ];
    }
}
