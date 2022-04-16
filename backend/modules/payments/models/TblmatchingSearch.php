<?php

namespace backend\modules\payments\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\payments\models\Tblmatching;

/**
 * TblmatchingSearch represents the model behind the search form of `backend\modules\payments\models\Tblmatching`.
 */
class TblmatchingSearch extends Tblmatching
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member', 'rank', 'memberFrom', 'recordBy'], 'integer'],
            [['amount'], 'number'],
            [['recordDate'], 'safe'],
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
        $query = Tblmatching::find();

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
            'member' => $this->member,
            'rank' => $this->rank,
            'memberFrom' => $this->memberFrom,
            'amount' => $this->amount,
            'recordDate' => $this->recordDate,
            'recordBy' => $this->recordBy,
        ]);

        return $dataProvider;
    }
}
