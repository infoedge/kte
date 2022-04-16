<?php

namespace backend\modules\messaging\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\messaging\models\Tblmsgtexts;

/**
 * TblmsgtextsSearch represents the model behind the search form of `backend\modules\messaging\models\Tblmsgtexts`.
 */
class TblmsgtextsSearch extends Tblmsgtexts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'msgType'], 'integer'],
            [['subject', 'msgText'], 'safe'],
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
        $query = Tblmsgtexts::find();

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
            'msgType' => $this->msgType,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'msgText', $this->msgText]);

        return $dataProvider;
    }
}
