<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Severity;

/**
 * SeveritySearch represents the model behind the search form about `app\models\Severity`.
 */
class SeveritySearch extends Severity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['severity_id', 'severity_date', 'clinic_id'], 'integer'],
            [['severity_text', 'severity_name', 'mail_to_boss'], 'safe'],
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
        $query = Severity::find();

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
            'severity_id' => $this->severity_id,
            'severity_date' => $this->severity_date,
            'clinic_id' => $this->clinic_id,
        ]);

        $query->andFilterWhere(['like', 'severity_text', $this->severity_text])
            ->andFilterWhere(['like', 'severity_name', $this->severity_name])
            ->andFilterWhere(['like', 'mail_to_boss', $this->mail_to_boss]);

        return $dataProvider;
    }
}
