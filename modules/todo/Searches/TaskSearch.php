<?php

namespace app\modules\todo\Searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\todo\models\Task\Task;

/**
 * TaskSearch represents the model behind the search form of `app\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['task', 'is_done', 'created_at', 'updatet_at'], 'safe'],
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
        $query = Task::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            /*
             * 'pagination' => [
                'pageSize' => 20,
            ],
            */
            'pagination' => false
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
            'is_done' => $this->is_done,
            'created_at' => $this->created_at
        ]);

        $query->andFilterWhere(['ilike', 'task', $this->task]);
        return $dataProvider;
    }
}
