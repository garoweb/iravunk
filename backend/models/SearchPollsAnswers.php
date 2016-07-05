<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PollsAnswers;

/**
 * SearchPollsAnswers represents the model behind the search form about `common\models\PollsAnswers`.
 */
class SearchPollsAnswers extends PollsAnswers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'poll_id'], 'integer'],
            [['answer'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = PollsAnswers::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'poll_id' => $this->poll_id,
        ]);

        $query->andFilterWhere(['like', 'answer', $this->answer]);

        return $dataProvider;
    }
}
