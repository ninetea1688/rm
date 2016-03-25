<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "source".
 *
 * @property integer $source_id
 * @property string $source_name
 */
class Source extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['source_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'source_id' => 'Source ID',
            'source_name' => 'Source Name',
        ];
    }
}
