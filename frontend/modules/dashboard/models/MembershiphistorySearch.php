<?php

namespace frontend\modules\dashboard\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\dashboard\models\Membershiphistory;

/**
 * MembershiphistorySearch represents the model behind the search form of `frontend\modules\dashboard\models\Membershiphistory`.
 */
class MembershiphistorySearch extends Membershiphistory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'memberId', 'packageId', 'status', 'rank', 'recordBy'], 'integer'],
            [['statusEndDate', 'expiryDate', 'dateStart', 'dateEnd', 'recordDate'], 'safe'],
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
        $query = Membershiphistory::find();

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
            'packageId' => $this->packageId,
            'status' => $this->status,
            'rank' => $this->rank,
            'statusEndDate' => $this->statusEndDate,
            'expiryDate' => $this->expiryDate,
            'dateStart' => $this->dateStart,
            'dateEnd' => $this->dateEnd,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
        ]);

        return $dataProvider;
    }
    public function searchByMember($memberId,$params)
    {
        $query = Membershiphistory::find()->where(['memberId'=>$memberId]);

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
            'packageId' => $this->packageId,
            'status' => $this->status,
            'rank' => $this->rank,
            'statusEndDate' => $this->statusEndDate,
            'expiryDate' => $this->expiryDate,
            'dateStart' => $this->dateStart,
            'dateEnd' => $this->dateEnd,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
        ]);

        return $dataProvider;
    }
}
