<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Risk;

/**
 * RiskSearch represents the model behind the search form about `app\models\Risk`.
 */
class RiskSearch extends Risk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['risk_id',  'clinic_id', 'severity_level', 'born_id', 'source_id', 'edit_dep_id', 'edit_user_id', 'review_id', 'follow_id'], 'integer'],
            [['date_stamp', 'incident_detail', 'pro_risk_id', 'pro_risk_detail_id', 'pro_risk_sub_detail_id', 'incident_id', 'date_risk', 'detail_prob', 'date_edit', 'method', 'review_date', 'review_detail'], 'safe'],
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
        $query = Risk::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('prorisk');
        $query->joinWith('proriskdetail');
        $query->joinWith('prorisksubdetail');
        $query->joinWith('incident');

        $query->andFilterWhere(['like', 'detail_prob', $this->detail_prob])
            ->andFilterWhere(['like', 'method', $this->method])
            ->andFilterWhere(['like', 'incident_detail', $this->incident_detail])
            ->andFilterWhere(['like', 'review_detail', $this->review_detail])
            ->andFilterWhere(['like', 'pro_risk.pro_risk_name', $this->pro_risk_id])
            ->andFilterWhere(['like', 'pro_risk_detail.pro_risk_detail_name', $this->pro_risk_detail_id])
            ->andFilterWhere(['like', 'pro_risk_sub_detail.pro_risk_sub_detail_name', $this->pro_risk_sub_detail_id])
            ->andFilterWhere(['like', 'incident.incident_name', $this->incident_id]);

        return $dataProvider;
    }
}
