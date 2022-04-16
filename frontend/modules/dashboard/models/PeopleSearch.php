<?php

namespace frontend\modules\dashboard\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\dashboard\models\People;

/**
 * PeopleSearch represents the model behind the search form of `frontend\modules\dashboard\models\People`.
 */
class PeopleSearch extends People
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'titleId', 'IdentityType', 'nationality', 'city', 'gender', 'recordBy'], 'integer'],
            [['surname', 'otherNames', 'firstName', 'identityNo', 'dob', 'phoneNo', 'recordDate'], 'safe'],
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
        $query = People::find();

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
            'titleId' => $this->titleId,
            'IdentityType' => $this->IdentityType,
            'nationality' => $this->nationality,
            'city' => $this->city,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
        ]);

        $query->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'otherNames', $this->otherNames])
            ->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'identityNo', $this->identityNo])
            ->andFilterWhere(['like', 'phoneNo', $this->phoneNo]);

        return $dataProvider;
    }
}
