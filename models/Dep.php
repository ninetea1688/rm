<?php

namespace app\models;
use app\models\Group;

use Yii;

/**
 * This is the model class for table "dep".
 *
 * @property integer $dep_id
 * @property string $dep_name
 * @property integer $group_id
 */
class Dep extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dep';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id'], 'integer'],
            [['dep_name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dep_id' => 'Dep ID',
            'dep_name' => 'Dep Name',
            'group_id' => 'Group ID',
            'groupname'=>'กลุ่มงาน',
               ];
    }
    public function getGroup() {
        return @$this->hasOne(Group::className(), ['group_id' => 'group_id']);
    }

    public function getGroupName() {
        return @$this->group->group_name;
    }
    
}
