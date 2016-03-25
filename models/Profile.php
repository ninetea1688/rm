<?php

namespace app\models;
use app\models\Team;
use app\models\Level;
use app\models\Dep;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $public_email
 * @property string $gravatar_email
 * @property string $gravatar_id
 * @property string $location
 * @property string $website
 * @property string $bio
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','dep_id','name'], 'required'],
            [['user_id','level_id','dep_id','team_id'], 'integer'],
            [['bio'], 'string'],
            [['name', 'public_email', 'gravatar_email', 'location', 'website'], 'string', 'max' => 255],
            [['gravatar_id'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'ชื่อ-สกุล',
            'public_email' => 'Public Email',
            'gravatar_email' => 'Gravatar Email',
            'gravatar_id' => 'Gravatar ID',
            'location' => 'Location',
            'website' => 'Website',
            'bio' => 'Bio',
            'dep_id'=>'หน่วยงานที่สั่งกัด',
            'team_id'=>'สายงาน',
            'level_id'=>'ระดับสิทธิ',
            
            'levelname'=>'ระดับการใช้งาน',
            'depname'=>'หน่วยงาน',
            'teamname'=>'สายงาน'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
      public function getDep(){
        return @$this->hasOne(Dep::className(),['dep_id'=>'dep_id']);
    }
    public function getDepName(){
        return @$this->dep->dep_name;
    }
      public function getTeam(){
        return @$this->hasOne(Team::className(),['team_id'=>'team_id']);
    }
    public function getTeamName(){
        return @$this->team->team_name;
    }
      public function getLevel(){
        return @$this->hasOne(Level::className(),['level_id'=>'level_id']);
    }
    public function getLevelName(){
        return @$this->level->level_name;
    }
}
