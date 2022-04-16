<?php

namespace backend\modules\video\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\video\models\Videolist;

/**
 * VideolistSearch represents the model behind the search form of `backend\modules\video\models\Videolist`.
 */
class VideolistSearch extends Videolist
{
    public $topic;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vTopic', 'videoType', 'order'], 'integer'],
            [['vid', 'vDesc', 'vName', 'fromDate', 'toDate','vTopic0.topicName'], 'safe'],
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
    
    public function attributes() {
        return array_merge(parent::attributes(),['vTopic0.topicName']);
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
        $query = Videolist::find()->orderBy('vTopic DESC, order DESC, id DESC,');

        // add conditions that should always apply here
        
        $query->joinWith('vTopic0 As videoTopic');

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
            'vTopic' => $this->vTopic,
            'videoType' => $this->videoType,
            'order' => $this->order,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
        ]);

        $query->andFilterWhere(['like', 'vid', $this->vid])
            ->andFilterWhere(['like', 'vDesc', $this->vDesc])
            ->andFilterWhere(['like', 'vName', $this->vName])
            ->andFilterWhere(['like','videoTopic.topicName',$this->getAttribute('vTopic0.topicName')]);

        return $dataProvider;
    }
}
