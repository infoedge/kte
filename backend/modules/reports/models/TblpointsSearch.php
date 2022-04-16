<?php

namespace backend\modules\reports\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\reports\models\Tblpoints;

/**
 * TblpointsSearch represents the model behind the search form of `backend\modules\reports\models\Tblpoints`.
 */
class TblpointsSearch extends Tblpoints
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sponsor', 'memberFrom', 'bonusType', 'relLevel', 'recordBy', 'CashInBy'], 'integer'],
            [['points'], 'number'],
            [['recordDate', 'cashInDate'], 'safe'],
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
        $query = Tblpoints::find();

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
            'sponsor' => $this->sponsor,
            'memberFrom' => $this->memberFrom,
            'bonusType' => $this->bonusType,
            'relLevel' => $this->relLevel,
            'points' => $this->points,
            'recordDate' => $this->recordDate,
            'recordBy' => $this->recordBy,
            'cashInDate' => $this->cashInDate,
            'CashInBy' => $this->CashInBy,
        ]);

        return $dataProvider;
    }
}
