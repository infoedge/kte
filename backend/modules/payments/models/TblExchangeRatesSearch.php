<?php

namespace backend\modules\payments\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\payments\models\TblExchangeRates;

/**
 * TblExchangeRatesSearch represents the model behind the search form of `backend\modules\payments\models\TblExchangeRates`.
 */
class TblExchangeRatesSearch extends TblExchangeRates
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'currency'], 'integer'],
            [['rate'], 'number'],
            [['fromDate', 'toDate','currency0.currencyName'], 'safe'],
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
    
    public function attributes() {
        return array_merge(parent::attributes(),['currency0.currencyName']);
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
        $query = TblExchangeRates::find();

        // add conditions that should always apply here
        $query->joinWith('currency0 As Curency');

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
            'currency' => $this->currency,
            'rate' => $this->rate,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
        ]);

        $query->andFilterWhere(['like', 'Curency.currencyName', $this->getAttribute('currency0.currencyName')]);
        
        return $dataProvider;
    }
}
