<?php

namespace backend\modules\reports\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\reports\models\Sponsorship;

/**
 * SponsorshipSearch represents the model behind the search form of `backend\modules\reports\models\Sponsorship`.
 */
class SponsorshipSearch extends Sponsorship
{
    public $memberName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member', 'status', 'membershipNo', 'parent', 'lft', 'rgt', 'position', 'sponsor', 'level', 'Rank', 'prefPosition', 'RecordBy', 'ChangedBy'], 'integer'],
            [['prefix', 'RecordDate','memberName', 'FullName', 'ChangedDate'], 'safe'],
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

        //
        $query->joinWith('member0');
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

        $query->andFilterWhere(['like', 'prefix', $this->prefix])
                ->andFilterWhere(['like', 'memberName', $this->member]);

        return $dataProvider;
    }
}
