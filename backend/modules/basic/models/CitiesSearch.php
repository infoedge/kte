<?php

namespace backend\modules\basic\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\basic\models\Cities;

/**
 * CitiesSearch represents the model behind the search form of `backend\modules\basic\models\Cities`.
 */
class CitiesSearch extends Cities
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'country', 'geonameid'], 'integer'],
            [['city', 'area','country0.Name'], 'safe'],
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
        return array_merge(parent::attributes(),['country0.Name']);
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
        $query = Cities::find()->orderBy('city ASC');

        // add conditions that should always apply here
        
        $query->joinWith('country0 As country');

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
            'country' => $this->country,
            'geonameid' => $this->geonameid,
        ]);

        $query->andFilterWhere(['like', 'city', $this->city])
                ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'country.Name', $this->getAttribute('country0.Name')]);

        return $dataProvider;
    }
}
