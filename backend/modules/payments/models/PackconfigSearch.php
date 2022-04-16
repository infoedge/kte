<?php

namespace backend\modules\payments\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\payments\models\Packconfig;

/**
 * PackconfigSearch represents the model behind the search form of `backend\modules\payments\models\Packconfig`.
 */
class PackconfigSearch extends Packconfig
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'packId', 'trxType', 'recordBy', 'changedBy'], 'integer'],
            [['amount', 'sponsorPoints', 'cyclePoints'], 'number'],
            [['recordDate', 'changeDate'], 'safe'],
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
        $query = Packconfig::find();

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
            'packId' => $this->packId,
            'trxType' => $this->trxType,
            'amount' => $this->amount,
            'sponsorPoints'=> $this->sponsorPoints, 
            'cyclePoints' => $this->cyclePoints,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
            'changedBy' => $this->changedBy,
            'changeDate' => $this->changeDate,
        ]);

        return $dataProvider;
    }
}
