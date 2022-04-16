<?php

namespace backend\modules\dashboard\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\dashboard\models\Tblcycleearnings;

/**
 * TblcycleearningsSearch represents the model behind the search form of `backend\modules\dashboard\models\Tblcycleearnings`.
 */
class TblcycleearningsSearch extends Tblcycleearnings
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member', 'trxToWalletBy'], 'integer'],
            [['earnDate', 'calcMatchBonus', 'trxToWalletDate'], 'safe'],
            [['cycles', 'amount'], 'number'],
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
        $query = Tblcycleearnings::find();

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
            'earnDate' => $this->earnDate,
            'cycles' => $this->cycles,
            'amount' => $this->amount,
            'calcMatchBonus' => $this->calcMatchBonus,
            'trxToWalletDate' => $this->trxToWalletDate,
            'trxToWalletBy' => $this->trxToWalletBy,
        ]);

        return $dataProvider;
    }
    
    public function searchByMember($memberId,$params)
    {
        $query = Tblcycleearnings::find()->where(['member'=>$memberId])->orderBy('earnDate DESC');

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
            'earnDate' => $this->earnDate,
            'cycles' => $this->cycles,
            'amount' => $this->amount,
            'calcMatchBonus' => $this->calcMatchBonus,
            'trxToWalletDate' => $this->trxToWalletDate,
            'trxToWalletBy' => $this->trxToWalletBy,
        ]);

        return $dataProvider;
    }
}
