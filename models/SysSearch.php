<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sys;

/**
 * SysSearch represents the model behind the search form about `app\models\Sys`.
 */
class SysSearch extends Sys
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_id'], 'integer'],
            [['sys_name', 'sys_status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Sys::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'sys_id' => $this->sys_id,
        ]);

        $query->andFilterWhere(['like', 'sys_name', $this->sys_name])
            ->andFilterWhere(['like', 'sys_status', $this->sys_status]);

        return $dataProvider;
    }
}
