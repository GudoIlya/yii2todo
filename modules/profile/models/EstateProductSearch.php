<?php

namespace app\modules\profile\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\profile\models\EstateProduct;

/**
 * UsersResourcesSearch represents the model behind the search form of `app\modules\bills\models\UsersResources`.
 */
class EstateProductSearch extends EstateProduct
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estate_id', 'product_id', 'rate_id'], 'integer'],
            [['default_value', 'date_create'], 'safe'],
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
        $query = EstateProduct::find()->alias('ep')
        ->innerJoin('jkh_product jp', 'jp.id = ep.product_id AND jp.user_id = '.Yii::$app->user->id);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ep.estate_id' => $this->estate_id,
            'ep.product_id' => $this->product_id,
            'ep.rate_id' => $this->rate_id,
        ]);

        return $dataProvider;
    }
}
