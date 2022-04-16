<?php

namespace backend\modules\video\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\video\models\Videotopics;

/**
 * VideotopicsSearch represents the model behind the search form of `backend\modules\video\models\Videotopics`.
 */
class VideotopicsSearch extends Videotopics
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['topicName','vTopic0.topicName'], 'safe'],
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
        $query = Videotopics::find();

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
        ]);

        $query->andFilterWhere(['like', 'topicName', $this->topicName]);

        return $dataProvider;
    }
}
