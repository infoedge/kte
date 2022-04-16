<?php

namespace frontend\modules\payments\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\payments\models\Tblfundstransfer;

/**
 * TblfundstransferSearch represents the model behind the search form of `frontend\modules\payments\models\Tblfundstransfer`.
 */
class TblfundstransferSearch extends Tblfundstransfer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'memberFrom', 'memberTo', 'recordBy', 'changedby'], 'integer'],
            [['fundsTrxCode', 'dateGen', 'fundsRcvCode', 'dateAccepted', 'recordDate', 'changedDate'], 'safe'],
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
        $query = Tblfundstransfer::find();

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
            'memberFrom' => $this->memberFrom,
            'amount' => $this->amount,
            'dateGen' => $this->dateGen,
            'memberTo' => $this->memberTo,
            'dateAccepted' => $this->dateAccepted,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
            'changedby' => $this->changedby,
            'changedDate' => $this->changedDate,
        ]);

        $query->andFilterWhere(['like', 'fundsTrxCode', $this->fundsTrxCode])
            ->andFilterWhere(['like', 'fundsRcvCode', $this->fundsRcvCode]);

        return $dataProvider;
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param int MemberId
     * @return ActiveDataProvider
     */
    public function searchByMember($memberId,$params)
    {
        $query = Tblfundstransfer::find()->where(['memberFrom'=>$memberId])->orderBy('dateGen DESC');

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
            'memberFrom' => $this->memberFrom,
            'amount' => $this->amount,
            'dateGen' => $this->dateGen,
            'memberTo' => $this->memberTo,
            'dateAccepted' => $this->dateAccepted,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
            'changedby' => $this->changedby,
            'changedDate' => $this->changedDate,
        ]);

        $query->andFilterWhere(['like', 'fundsTrxCode', $this->fundsTrxCode])
            ->andFilterWhere(['like', 'fundsRcvCode', $this->fundsRcvCode]);

        return $dataProvider;
    }
}
