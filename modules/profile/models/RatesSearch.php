<?php

namespace app\modules\profile\models;

use app\models\UserCustom;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\profile\models\Rates;

/**
 * RatesSearch represents the model behind the search form of `app\modules\bills\models\Rates`.
 */
class RatesSearch extends Rates
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id'], 'integer'],
            [['name', 'price', 'unit', 'date_create'], 'safe'],
            [['price'], 'number'],
            [['unit'], 'string', 'max' => 100],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jkhproduct::className(), 'targetAttribute' => ['product_id' => 'id']]
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
        $query = Rates::find()
        ->innerJoin('jkh_product jp', 'jp.id = rate.id AND jp.user_id = '.UserCustom::getUserId());

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
            'unit' => $this->unit,
            'date_create' => $this->date_create,
            'product_id' => $this->product_id
        ]);

        $query->andFilterWhere(['ilike', 'rate.name', $this->name]);
        $query->andFilterWhere(['>', 'rate.price', $this->price]);

        return $dataProvider;
    }
}
