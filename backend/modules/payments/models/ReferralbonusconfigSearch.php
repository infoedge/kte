<?php

namespace backend\modules\payments\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\payments\models\Referralbonusconfig;

/**
 * ReferralbonusconfigSearch represents the model behind the search form of `backend\modules\payments\models\Referralbonusconfig`.
 */
class ReferralbonusconfigSearch extends Referralbonusconfig
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sPackage', 'sRank', 'mPackage', 'recordBy'], 'integer'],
            [['level', 'amount'], 'number'],
            [['recordDate', 'configCntrl'], 'safe'],
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
        $query = Referralbonusconfig::find();

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
            'sPackage' => $this->sPackage,
            'sRank' => $this->sRank,
            'mPackage' => $this->mPackage,
            'level' => $this->level,
            'amount' => $this->amount,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
        ]);

        $query->andFilterWhere(['like', 'configCntrl', $this->configCntrl]);

        return $dataProvider;
    }
}
