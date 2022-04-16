<?php

namespace backend\modules\reports\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\reports\models\Tempsponsor;

/**
 * TempsponsorSearch represents the model behind the search form of `backend\modules\reports\models\Tempsponsor`.
 */
class TempsponsorSearch extends Tempsponsor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member','sponsor' , 'parent', 'lft', 'parMethod', 'RecordBy'], 'integer'],
            [['RecordDate','pstatus','sMemberNo'], 'safe'],
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
        $query = Tempsponsor::find()->joinWith(['member0.people.sponsorship'=>function($query){
                $query->andWhere(['membershipNo'=>null]);
        },]);

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
            'member' => $this->member,
            'sponsor' => $this->sponsor,
            'parent' => $this->parent,
            'lft' => $this->lft,
            'parMethod' => $this->parMethod,
            'RecordBy' => $this->RecordBy,
            'RecordDate' => $this->RecordDate,
            'email'=>null,
        ]);

       //$query->andFilterWhere(['like','MemberNo',$this->sponsor]);
        //$query->andFilterWhere(['like','pstatus',$this->ProspectStatus]);
        
        return $dataProvider;
    }
}
