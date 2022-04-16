<?php

namespace backend\modules\dashboard\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\dashboard\models\Tblcycles;

/**
 * TblcyclesSearch represents the model behind the search form of `backend\modules\dashboard\models\Tblcycles`.
 */
class TblcyclesSearch extends Tblcycles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member', 'memberFrom', 'cyclesValid', 'trxBy'], 'integer'],
            [['lft', 'rgt'], 'number'],
            [['earnDate', 'comment', 'trxDate'], 'safe'],
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
        $query = Tblcycles::find();

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
            'memberFrom' => $this->memberFrom,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'earnDate' => $this->earnDate,
            'cyclesValid' => $this->cyclesValid,
            'trxDate' => $this->trxDate,
            'trxBy' => $this->trxBy,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
    public function searchByMember($memberid,$params)
    {
        $query = Tblcycles::find()->where(['member'=>$memberid])->orderBy('earnDate DESC');

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
            'memberFrom' => $this->memberFrom,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'earnDate' => $this->earnDate,
            'cyclesValid' => 1,
            'trxDate' => $this->trxDate,
            'trxBy' => $this->trxBy,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
