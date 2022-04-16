<?php

namespace backend\modules\payments\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\payments\models\Tblgcodes;

/**
 * TblgcodesSearch represents the model behind the search form of `backend\modules\payments\models\Tblgcodes`.
 */
class TblgcodesSearch extends Tblgcodes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'memberGen', 'walletId', 'retrieveBy', 'recordBy', 'changedBy'], 'integer'],
            [['code', 'dateGen', 'recipientEmail', 'retrieveDate', 'expiryDate', 'recordDate', 'changedDate'], 'safe'],
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
        $query = Tblgcodes::find()->orderBy('dateGen DESC');

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
            'memberGen' => $this->memberGen,
            'dateGen' => $this->dateGen,
            'amount' => $this->amount,
            'walletId' => $this->walletId,
            'retrieveDate' => $this->retrieveDate,
            'retrieveBy' => $this->retrieveBy,
            'expiryDate' => $this->expiryDate,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
            'changedBy' => $this->changedBy,
            'changedDate' => $this->changedDate,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'recipientEmail', $this->recipientEmail]);

        return $dataProvider;
    }
}
