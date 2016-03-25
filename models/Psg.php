<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "psg".
 *
 * @property integer $psg_id
 * @property string $psgname
 */
class Psg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'psg';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['psgname'], 'required'],
            [['psgname'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'psg_id' => 'Psg ID',
            'psgname' => 'Psgname',
        ];
    }
}
