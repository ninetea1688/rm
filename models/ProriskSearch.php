<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prorisk;

/**
 * ProriskSearch represents the model behind the search form about `app\models\Prorisk`.
 */
class ProriskSearch extends Prorisk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_risk_id'], 'integer'],
            [['pro_risk_name'], 'safe'],
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
        $query = Prorisk::find();

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
            'pro_risk_id' => $this->pro_risk_id,
        ]);

        $query->andFilterWhere(['like', 'pro_risk_name', $this->pro_risk_name]);

        return $dataProvider;
    }
}
