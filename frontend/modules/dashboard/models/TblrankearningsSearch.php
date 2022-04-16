<?php

namespace frontend\modules\dashboard\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\dashboard\models\Tblrankearnings;

/**
 * TblrankearningsSearch represents the model behind the search form of `frontend\modules\dashboard\models\Tblrankearnings`.
 */
class TblrankearningsSearch extends Tblrankearnings
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member', 'rankAchieved', 'cashInBy', 'recordBy'], 'integer'],
            [['amount'], 'number'],
            [['cashInDate', 'recordDate'], 'safe'],
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
        $query = Tblrankearnings::find();

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
            'rankAchieved' => $this->rankAchieved,
            'amount' => $this->amount,
            'cashInDate' => $this->cashInDate,
            'cashInBy' => $this->cashInBy,
            'recordDate' => $this->recordDate,
            'recordBy' => $this->recordBy,
        ]);

        return $dataProvider;
    }
    
    public function searchByMember($memberId,$params)
    {
        $query = Tblrankearnings::find()->where(['member'=>$memberId]);

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
            'rankAchieved' => $this->rankAchieved,
            'amount' => $this->amount,
            'cashInDate' => $this->cashInDate,
            'cashInBy' => $this->cashInBy,
            'recordDate' => $this->recordDate,
            'recordBy' => $this->recordBy,
        ]);

        return $dataProvider;
    }
}
