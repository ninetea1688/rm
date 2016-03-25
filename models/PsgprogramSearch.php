<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Psgprogram;

/**
 * PsgprogramSearch represents the model behind the search form about `app\models\Psgprogram`.
 */
class PsgprogramSearch extends Psgprogram
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['psgp_id', 'psg_id', 'pro_risk_id', 'pro_risk_detail_id', 'pro_risk_sub_detail_id', 'incident_id'], 'safe'],
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
        $query = Psgprogram::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('psg');
        $query->joinWith('prorisk');
        $query->joinWith('proriskdetail');
        $query->joinWith('prorisksubdetail');
        $query->joinWith('incident');
        
        
        // grid filtering conditions
        $query->andFilterWhere([
            'psgp_id' => $this->psgp_id,                                    
        ]);
        
        $query->andFilterWhere(['like', 'psg.psgname', $this->psg_id])
                ->andFilterWhere(['like', 'pro_risk.pro_risk_name', $this->pro_risk_id])
                ->andFilterWhere(['like', 'pro_risk_detail.pro_risk_detail_name', $this->pro_risk_detail_id])
                ->andFilterWhere(['like', 'pro_risk_sub_detail.pro_risk_sub_detail_name', $this->pro_risk_sub_detail_id])
                ->andFilterWhere(['like', 'incident.incident_name', $this->incident_id]);

        return $dataProvider;
    }
}
