<?php

namespace backend\modules\payments\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\payments\models\Compensationtypes;

/**
 * CompensationtypesSearch represents the model behind the search form of `backend\modules\payments\models\Compensationtypes`.
 */
class CompensationtypesSearch extends Compensationtypes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['compTypeName'], 'safe'],
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
        $query = Compensationtypes::find();

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
        ]);

        $query->andFilterWhere(['like', 'compTypeName', $this->compTypeName]);

        return $dataProvider;
    }
}
