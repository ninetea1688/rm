<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys".
 *
 * @property integer $sys_id
 * @property string $sys_name
 * @property string $sys_status
 */
class Sys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_id'], 'required'],
            [['sys_id','sys_status'], 'integer'],
            [['sys_name'], 'string', 'max' => 150]
            //,[['sys_status'], 'string', 'max' => 1]
        ];
    }
    public function attributeLabels()
    {
        return [
            'sys_id' => 'Sys ID',
            'sys_name' => 'Sys Name',
            'sys_status' => 'Sys Status',
        ];
    }
}
