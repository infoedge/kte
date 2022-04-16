<?php

namespace backend\modules\payments\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\payments\models\Inpayments;

/**
 * InpaymentsSearch represents the model behind the search form of `backend\modules\payments\models\Inpayments`.
 */
class InpaymentsSearch extends Inpayments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member', 'ptype','package', 'recordBy'], 'integer'],
            [['amount'], 'number'],
            [['pdate', 'comments', 'recordDate'], 'safe'],
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
        $query = Inpayments::find();

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
            'ptype' => $this->ptype,
            'package' => $this->package,
            'amount' => $this->amount,
            'pdate' => $this->pdate,
            'recordDate' => $this->recordDate,
            'recordBy' => $this->recordBy,
        ]);

        $query->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchUnpaid($params)
    {
        $query = Inpayments::find()->where(['confirmed'=>null])->orWhere(['confirmed'=>0])
                ->orderBy('recordDate DESC');

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
            'ptype' => $this->ptype,
            'package' => $this->package,
            'amount' => $this->amount,
            'pdate' => $this->pdate,
            'recordDate' => $this->recordDate,
            'recordBy' => $this->recordBy,
        ]);

        $query->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}
