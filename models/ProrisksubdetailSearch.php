<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prorisksubdetail;

/**
 * ProrisksubdetailSearch represents the model behind the search form about `app\models\Prorisksubdetail`.
 */
class ProrisksubdetailSearch extends Prorisksubdetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'pro_risk_sub_detail_key'], 'integer'],
            [['pro_risk_sub_detail_name','pro_risk_id' ,'pro_risk_detail_id', 'pro_risk_sub_detail_id'], 'safe'],
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
        $query = Prorisksubdetail::find();

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

        $query->andFilterWhere([            
            'pro_risk_sub_detail_key' => $this->pro_risk_sub_detail_key,
        ]);

        $query->andFilterWhere(['like', 'pro_risk_sub_detail_name', $this->pro_risk_sub_detail_name])
              ->andFilterWhere(['like', 'pro_risk.pro_risk_name' , $this->pro_risk_id])
              ->andFilterWhere(['like', 'pro_risk_detail.pro_risk_detail_name', $this->pro_risk_detail_id]);

        return $dataProvider;
    }
}
