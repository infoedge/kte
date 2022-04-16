<?php

namespace backend\modules\messaging\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\messaging\models\Tblmsgtypes;

/**
 * TblmsgtypesSearch represents the model behind the search form of `backend\modules\messaging\models\Tblmsgtypes`.
 */
class TblmsgtypesSearch extends Tblmsgtypes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['typeName'], 'safe'],
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
        $query = Tblmsgtypes::find();

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

        $query->andFilterWhere(['like', 'typeName', $this->typeName]);

        return $dataProvider;
    }
}
