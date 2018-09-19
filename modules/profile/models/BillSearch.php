<?php

namespace app\modules\profile\models;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\profile\models\Bill;
use app\models\UserCustom;

/**
 * BillSearch represents the model behind the search form of `app\modules\bills\models\Bills`.
 */
class BillSearch extends Bill
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['bill_number', 'date_create'], 'safe'],
            [['estate_id'],'integer'],
            [['total'], 'number'],
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
        $query = Bill::find()
            ->alias('bl')
        ->innerJoin('estate et', 'et.user_id = '.UserCustom::getUserId());

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
            'estate_id' => $this->estate_id,
            'total' => 'total',
            'is_paid' => $this->is_paid,
        ]);

        $query->andFilterWhere(['ilike', 'billnumber', $this->bill-number]);

        return $dataProvider;
    }
}
