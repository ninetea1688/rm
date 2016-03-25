<?php

namespace app;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dep;

/**
 * modelsDepSearch represents the model behind the search form about `app\models\Dep`.
 */
class modelsDepSearch extends Dep
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ward_id', 'group_ward'], 'integer'],
            [['ward'], 'safe'],
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
        $query = Dep::find();

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
            'ward_id' => $this->ward_id,
            'group_ward' => $this->group_ward,
        ]);

        $query->andFilterWhere(['like', 'ward', $this->ward]);

        return $dataProvider;
    }
}
