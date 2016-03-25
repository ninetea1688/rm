<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "team".
 *
 * @property integer $team_id
 * @property string $team_name
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['team_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'team_id' => 'Team ID',
            'team_name' => 'Team Name',
        ];
    }
}
