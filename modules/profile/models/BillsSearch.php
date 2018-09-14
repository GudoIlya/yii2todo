<?php

namespace app\modules\profile\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\profile\models\Bills;

/**
 * BillSearch represents the model behind the search form of `app\modules\bills\models\Bills`.
 */
class BillsSearch extends Bills
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['bill_number', 'date'], 'safe'],
            [['services_summ', 'resources_summ'], 'number'],
            [['is_paid'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Bills::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'services_summ' => $this->services_summ,
            'resources_summ' => $this->resources_summ,
            'is_paid' => $this->is_paid,
        ]);

        $query->andFilterWhere(['ilike', 'bill-number', $this->bill-number]);

        return $dataProvider;
    }
}
