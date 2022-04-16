<?php

namespace frontend\modules\payments\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\payments\models\Tblwithdrawal;

/**
 * TblwithdrawalSearch represents the model behind the search form of `frontend\modules\payments\models\Tblwithdrawal`.
 */
class TblwithdrawalSearch extends Tblwithdrawal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member', 'withdrawalType', 'requestBy', 'status', 'approvedBy', 'recordBy'], 'integer'],
            [['accountNo', 'withdrawalCode', 'requestDate', 'approvedDate', 'recordDate','withdrawalType0.typeName','status0.statusName'], 'safe'],
            [['amount'], 'number'],
        ];
    }
    
    public function attributes() {
        return array_merge(parent::attributes(), ['withdrawalType0.typeName'],['status0.statusName']);
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
            'status' => $this->status,
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
    public function searchByMember($memberId,$params)
    {
        $query = Tblwithdrawal::find()->where(['member'=>$memberId])->orderBy('recordDate DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $query->joinWith('withdrawalType0 As wt');
        $query->joinWith('status0 As st');

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
            'status' => $this->status,
            'approvedBy' => $this->approvedBy,
            'approvedDate' => $this->approvedDate,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
        ]);

        $query->andFilterWhere(['like', 'accountNo', $this->accountNo])
            ->andFilterWhere(['like', 'withdrawalCode', $this->withdrawalCode])
            ->andFilterWhere(['like', 'wt.typeName', $this->getAttribute('withdrawalType0.typeName')])
            ->andFilterWhere(['like', 'st.statusName', $this->getAttribute('status0.statusName')]);

        return $dataProvider;
    }
}
