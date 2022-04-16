<?php

namespace backend\modules\payments\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\payments\models\Tblwithdrawal;

/**
 * TblwithdrawalSearch represents the model behind the search form of `backend\modules\payments\models\Tblwithdrawal`.
 */
class TblwithdrawalSearch extends Tblwithdrawal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member', 'withdrawalType', 'requestBy', 'approvedBy', 'recordBy'], 'integer'],
            [['accountNo', 'withdrawalCode', 'requestDate', 'approvedDate', 'recordDate'], 'safe'],
            [['amount'], 'number'],
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
        $query = Tblwithdrawal::find();

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
            'withdrawalType' => $this->withdrawalType,
            'amount' => $this->amount,
            'requestBy' => $this->requestBy,
            'requestDate' => $this->requestDate,
            'approvedBy' => $this->approvedBy,
            'approvedDate' => $this->approvedDate,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
        ]);

        $query->andFilterWhere(['like', 'accountNo', $this->accountNo])
            ->andFilterWhere(['like', 'withdrawalCode', $this->withdrawalCode]);

        return $dataProvider;
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchPending($params)
    {
        $query = Tblwithdrawal::find()->where(['approvedDate'=>null])->orderBy('recordDate DESC');

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
            'withdrawalType' => $this->withdrawalType,
            'amount' => $this->amount,
            'requestBy' => $this->requestBy,
            'requestDate' => $this->requestDate,
            'approvedBy' => $this->approvedBy,
            'approvedDate' => $this->approvedDate,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
        ]);

        $query->andFilterWhere(['like', 'accountNo', $this->accountNo])
            ->andFilterWhere(['like', 'withdrawalCode', $this->withdrawalCode]);

        return $dataProvider;
    }
}
