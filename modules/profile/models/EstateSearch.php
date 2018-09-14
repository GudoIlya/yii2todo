<?php

namespace app\modules\profile\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\profile\models\Estate;
use app\models\UserCustom;

/**
 * EstateSearch represents the model behind the search form of `app\modules\bills\models\Estate`.
 */
class EstateSearch extends Estate
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'space'], 'integer'],
            [['title'], 'safe'],
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
        $query = Estate::find()->innerJoin('estate_owners', 'estate_id = estate.id AND user_id = '.UserCustom::getUserId());

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
            'space' => $this->space,
        ]);

        $query->andFilterWhere(['ilike', 'title', $this->title]);

        return $dataProvider;
    }
}
