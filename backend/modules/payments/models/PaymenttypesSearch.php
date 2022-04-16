<?php

namespace backend\modules\payments\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\payments\models\Paymenttypes;

/**
 * PaymenttypesSearch represents the model behind the search form of `backend\modules\payments\models\Paymenttypes`.
 */
class PaymenttypesSearch extends Paymenttypes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ptypeName'], 'safe'],
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
        $query = Paymenttypes::find();

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

        $query->andFilterWhere(['like', 'ptypeName', $this->ptypeName]);

        return $dataProvider;
    }
}
