<?php

namespace frontend\modules\basic\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\basic\models\Contacts;

/**
 * ContactsSearch represents the model behind the search form about `backend\modules\basic\models\Contacts`.
 */
class ContactsSearch extends Contacts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'PersonId', 'ContactType', 'recordBy', 'changedBy'], 'integer'],
            [['ContactsValue', 'recordDate', 'changedDate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Contacts::find();

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
            'PersonId' => $this->PersonId,
            'ContactType' => $this->ContactType,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
            'changedBy' => $this->changedBy,
            'changedDate' => $this->changedDate,
        ]);

        $query->andFilterWhere(['like', 'ContactsValue', $this->ContactsValue]);

        return $dataProvider;
    }
}
