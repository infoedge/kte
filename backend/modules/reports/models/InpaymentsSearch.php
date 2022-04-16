<?php

namespace backend\modules\reports\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\reports\models\Inpayments;

/**
 * InpaymentsSearch represents the model behind the search form of `backend\modules\reports\models\Inpayments`.
 */
class InpaymentsSearch extends Inpayments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member', 'package', 'ptype', 'pMethod', 'confirmed', 'confirmBy', 'recordBy'], 'integer'],
            [['amount'], 'number'],
            [['pdate', 'transactionNo', 'confirmDate', 'comments', 'recordDate'], 'safe'],
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
            'package' => $this->package,
            'ptype' => $this->ptype,
            'amount' => $this->amount,
            'pdate' => $this->pdate,
            'pMethod' => $this->pMethod,
            'confirmed' => $this->confirmed,
            'confirmBy' => $this->confirmBy,
            'confirmDate' => $this->confirmDate,
            'recordDate' => $this->recordDate,
            'recordBy' => $this->recordBy,
        ]);

        $query->andFilterWhere(['like', 'transactionNo', $this->transactionNo])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}
