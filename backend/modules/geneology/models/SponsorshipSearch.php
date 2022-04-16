<?php

namespace backend\modules\genealogy\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\genealogy\models\Sponsorship;

/**
 * SponsorshipSearch represents the model behind the search form of `backend\modules\genealogy\models\Sponsorship`.
 */
class SponsorshipSearch extends Sponsorship
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member', 'status', 'membershipNo', 'parent', 'sponsor', 'level', 'RecordBy', 'ChangedBy'], 'integer'],
            [['Rank', 'RecordDate', 'ChangedDate'], 'safe'],
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
            'sponsor' => $this->sponsor,
            'level' => $this->level,
            'RecordBy' => $this->RecordBy,
            'RecordDate' => $this->RecordDate,
            'ChangedBy' => $this->ChangedBy,
            'ChangedDate' => $this->ChangedDate,
        ]);

        $query->andFilterWhere(['like', 'Rank', $this->Rank]);

        return $dataProvider;
    }
}
