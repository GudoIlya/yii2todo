<?php

namespace app\modules\profile\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\profile\models\Jkhproduct;
use app\models\UserCustom;


/**
 * EstateSearch represents the model behind the search form of `app\modules\bills\models\Estate`.
 */
class JkhproductSearch extends Jkhproduct
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'description', 'type'], 'safe'],
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
        $query = Jkhproduct::find()->where('user_id = '.UserCustom::getUserId());;

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
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name]);
        $query->andFilterWhere(['ilike', 'description', $this->description]);

        return $dataProvider;
    }

    /**
     * Возвращает массив товаров, котоыре принадлежат пользователю
     */
    public function getJkhProductModels() {
        $jkhproducts = $this->search(Yii::$app->request->queryParams);
        return $jkhproducts;
    }

}
