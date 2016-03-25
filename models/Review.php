<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property integer $review_id
 * @property string $review_name
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['review_name'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'review_id' => 'Review ID',
            'review_name' => 'Review Name',
        ];
    }
}
