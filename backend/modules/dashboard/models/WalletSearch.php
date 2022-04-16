<?php

namespace backend\modules\dashboard\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\dashboard\models\Wallet;

/**
 * WalletSearch represents the model behind the search form of `backend\modules\payments\models\Wallet`.
 */
class WalletSearch extends Wallet
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member', 'trxMethod', 'trxDir', 'recordBy'], 'integer'],
            [['fromTable', 'trxDate', 'trxId', 'recordDate'], 'safe'],
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
        $query = Wallet::find();

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
            'trxDate' => $this->trxDate,
            'trxMethod' => $this->trxMethod,
            'trxDir' => $this->trxDir,
            'amount' => $this->amount,
            'recordDate' => $this->recordDate,
            'recordBy' => $this->recordBy,
        ]);

        $query->andFilterWhere(['like', 'fromTable', $this->fromTable])
            ->andFilterWhere(['like', 'trxId', $this->trxId]);

        return $dataProvider;
    }
    public function searchByMember($memberId,$params)
    {
        $query = Wallet::find()->where(['member'=>$memberId])->orderBy('trxDate DESC');

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
            'trxDate' => $this->trxDate,
            'trxMethod' => $this->trxMethod,
            'trxDir' => $this->trxDir,
            'amount' => $this->amount,
            'recordDate' => $this->recordDate,
            'recordBy' => $this->recordBy,
        ]);

        $query->andFilterWhere(['like', 'fromTable', $this->fromTable])
            ->andFilterWhere(['like', 'trxId', $this->trxId]);

        return $dataProvider;
    }
}
