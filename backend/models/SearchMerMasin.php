<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MerMasin;

/**
 * SearchMerMasin represents the model behind the search form about `common\models\MerMasin`.
 */
class SearchMerMasin extends MerMasin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hits', 'type', 'user_id'], 'integer'],
            [['title', 'content', 'meta_key', 'created'], 'safe'],
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
        $query = MerMasin::find();

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
            'created' => $this->created,
            'hits' => $this->hits,
            'type' => $this->type,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'meta_key', $this->meta_key]);

        return $dataProvider;
    }
}
