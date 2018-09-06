<?php

namespace app\modules\bills\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\bills\models\UsersResources;

/**
 * UsersResourcesSearch represents the model behind the search form of `app\modules\bills\models\UsersResources`.
 */
class UsersResourcesSearch extends UsersResources
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'resource_id', 'user_id'], 'integer'],
            [['date_create'], 'safe'],
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
        $query = UsersResources::find();

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
            'resource_id' => $this->resource_id,
            'user_id' => $this->user_id,
            'date_create' => $this->date_create,
        ]);

        return $dataProvider;
    }
}
