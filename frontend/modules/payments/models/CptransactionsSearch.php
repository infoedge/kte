<?php

namespace frontend\modules\payments\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\payments\models\Cptransactions;

/**
 * CptransactionsSearch represents the model behind the search form of `frontend\modules\payments\models\Cptransactions`.
 */
class CptransactionsSearch extends Cptransactions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'memberId', 'trxId', 'packId', 'confirms_needed'], 'integer'],
            [['dateStart', 'bc_trx_id', 'trxNo', 'status', 'statusDate', 'address', 'dest_tag'], 'safe'],
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
        $query = Cptransactions::find();

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
            'memberId' => $this->memberId,
            'trxId' => $this->trxId,
            'packId' => $this->packId,
            'dateStart' => $this->dateStart,
            'amount' => $this->amount,
            'statusDate' => $this->statusDate,
            'confirms_needed' => $this->confirms_needed,
        ]);

        $query->andFilterWhere(['like', 'bc_trx_id', $this->bc_trx_id])
            ->andFilterWhere(['like', 'trxNo', $this->trxNo])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'dest_tag', $this->dest_tag]);

        return $dataProvider;
    }
}
