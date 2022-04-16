<?php

namespace backend\modules\messaging\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\messaging\models\Tblmessages;

/**
 * TblmessagesSearch represents the model behind the search form of `backend\modules\messaging\models\Tblmessages`.
 */
class TblmessagesSearch extends Tblmessages
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'msgId', 'sentBy', 'sentTo', 'recordBy'], 'integer'],
            [['dateSent', 'confirmMsgSentDate', 'recordDate'], 'safe'],
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
        $query = Tblmessages::find();

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
            'msgId' => $this->msgId,
            'sentBy' => $this->sentBy,
            'sentTo' => $this->sentTo,
            'dateSent' => $this->dateSent,
            'confirmMsgSentDate' => $this->confirmMsgSentDate,
            'recordBy' => $this->recordBy,
            'recordDate' => $this->recordDate,
        ]);

        return $dataProvider;
    }
}
