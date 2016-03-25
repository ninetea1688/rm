<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "born".
 *
 * @property integer $born_id
 * @property string $born_name
 */
class Born extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'born';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['born_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'born_id' => 'Born ID',
            'born_name' => 'Born Name',
        ];
    }
}
