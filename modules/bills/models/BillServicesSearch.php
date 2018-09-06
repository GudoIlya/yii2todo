<?php

namespace app\modules\bills\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\bills\models\BillServices;

/**
 * BillServicesSearch represents the model behind the search form of `app\modules\bills\models\BillServices`.
 */
class BillServicesSearch extends BillServices
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'service_id', 'bill_id', 'rate_id'], 'integer'],
            [['quantity', 'summ'], 'number'],
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
        $query = BillServices::find();

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
            'service_id' => $this->service_id,
            'bill_id' => $this->bill_id,
            'rate_id' => $this->rate_id,
            'quantity' => $this->quantity,
            'summ' => $this->summ,
        ]);

        return $dataProvider;
    }
}
