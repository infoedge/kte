<?php

namespace backend\modules\basic\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\basic\models\Dialcodes;

/**
 * DialcodesSearch represents the model behind the search form of `backend\modules\basic\models\Dialcodes`.
 */
class DialcodesSearch extends Dialcodes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'c_id', 'countryCode'], 'integer'],
            [['exitCode', 'trunkCode','c.Name'], 'safe'],
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
    
    public function attributes(){
        return array_merge(parent::attributes(),['c.Name']);
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
        $query = Dialcodes::find();

        // add conditions that should always apply here
        $query->joinWith('c As country');

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
            'c_id' => $this->c_id,
            'countryCode' => $this->countryCode,
        ]);

        $query->andFilterWhere(['like', 'exitCode', $this->exitCode])
                ->andFilterWhere(['like', 'trunkCode', $this->trunkCode])
            ->andFilterWhere(['like', 'country.Name',  $this->getAttribute('c.Name')]);

        return $dataProvider;
    }
}
