<?php

namespace frontend\modules\dashboard\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\dashboard\models\Sponsorship;

/**
 * SponsorshipSearch represents the model behind the search form of `frontend\modules\dashboard\models\Sponsorship`.
 */
class SponsorshipSearch extends Sponsorship
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member', 'status', 'membershipNo', 'parent', 'lft', 'rgt', 'position', 'sponsor', 'level', 'Rank', 'prefPosition', 'RecordBy', 'ChangedBy'], 'integer'],
            [['RecordDate', 'ChangedDate'], 'safe'],
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
        $query = Sponsorship::find();

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
            'status' => $this->status,
            'membershipNo' => $this->membershipNo,
            'parent' => $this->parent,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'position' => $this->position,
            'sponsor' => $this->sponsor,
            'level' => $this->level,
            'Rank' => $this->Rank,
            'prefPosition' => $this->prefPosition,
            'RecordBy' => $this->RecordBy,
            'RecordDate' => $this->RecordDate,
            'ChangedBy' => $this->ChangedBy,
            'ChangedDate' => $this->ChangedDate,
        ]);

        return $dataProvider;
    }
    public function searchBySponsor($memberId,$params)
    {
        $query = Sponsorship::find()->orderBy('RecordDate DESC');

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
            'status' => $this->status,
            'membershipNo' => $this->membershipNo,
            'parent' => $this->parent,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'position' => $this->position,
            'sponsor' => $memberId,
            'level' => $this->level,
            'Rank' => $this->Rank,
            'prefPosition' => $this->prefPosition,
            'RecordBy' => $this->RecordBy,
            'RecordDate' => $this->RecordDate,
            'ChangedBy' => $this->ChangedBy,
            'ChangedDate' => $this->ChangedDate,
        ]);

        return $dataProvider;
    }
    public function teamLev2($memberId){
        return (new \yii\db\Query())
                ->select('member')
                ->from('sponsorship')
                ->where(['sponsor'=>$memberId])
                ->all();
    }
    public function searchSponsorLev2($memberId,$params)
    {
        $query = Sponsorship::find();

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
            'status' => $this->status,
            'membershipNo' => $this->membershipNo,
            'parent' => $this->parent,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'position' => $this->position,
            'sponsor' => $this->teamLev2($memberId),
            'level' => $this->level,
            'Rank' => $this->Rank,
            'prefPosition' => $this->prefPosition,
            'RecordBy' => $this->RecordBy,
            'RecordDate' => $this->RecordDate,
            'ChangedBy' => $this->ChangedBy,
            'ChangedDate' => $this->ChangedDate,
        ]);

        return $dataProvider;
    }
}
