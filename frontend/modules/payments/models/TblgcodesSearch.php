<?php

namespace frontend\modules\payments\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\payments\models\Tblgcodes;

/**
 * TblgcodesSearch represents the model behind the search form of `frontend\modules\payments\models\Tblgcodes`.
 */
class TblgcodesSearch extends Tblgcodes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'memberGen', 'retrieveBy', 'recordBy', 'changedBy'], 'integer'],
            [['code', 'dateGen', 'retrieveDate', 'recordDate', 'changedDate'], 'safe'],
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
        $query = Tblgcodes::find();

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
            'retrieveDate' => $this->retrieveDate,
            'retrieveBy' => $this->retrieveBy,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
            'changedBy' => $this->changedBy,
            'changedDate' => $this->changedDate,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchByMemberId($memberId,$params)
    {
        $query = Tblgcodes::find()->where(['memberGen'=>$memberId])->orderBy('dateGen DESC');

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
            'retrieveDate' => $this->retrieveDate,
            'retrieveBy' => $this->retrieveBy,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
            'changedBy' => $this->changedBy,
            'changedDate' => $this->changedDate,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
