<?php

namespace backend\modules\basic\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Appconstants;

/**
 * AppconstantsSearch represents the model behind the search form of `common\models\Appconstants`.
 */
class AppconstantsSearch extends Appconstants
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'constantUnits', 'recordBy'], 'integer'],
            [['constantName', 'fromDate', 'toDate', 'recordDate'], 'safe'],
            [['constantValue'], 'number'],
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
        $query = Appconstants::find();

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
            'constantValue' => $this->constantValue,
            'constantUnits' => $this->constantUnits,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
        ]);

        $query->andFilterWhere(['like', 'constantName', $this->constantName]);

        return $dataProvider;
    }
}
