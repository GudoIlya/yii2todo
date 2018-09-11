<?php

namespace app\modules\bills\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\bills\models\Resources;

/**
 * ResourcesSearch represents the model behind the search form of `app\modules\bills\models\Resources`.
 */
class ResourcesSearch extends Resources
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'current_rate'], 'integer'],
            [['name', 'description'], 'safe'],
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
        $query = Resources::find();

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
            'current_rate' => $this->current_rate,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'description', $this->description]);

        return $dataProvider;
    }
}