<?php

namespace backend\modules\reports\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\reports\models\Sponsorship;

/**
 * SponsorshipSearch represents the model behind the search form of `backend\modules\reports\models\Sponsorship`.
 */
class SponsorshipSearch extends Sponsorship
{
    public $memberName;
    public $recDate;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member', 'status', 'membershipNo', 'parent', 'lft', 'rgt', 'position', 'sponsor', 'level', 'Rank', 'prefPosition', 'RecordBy', 'ChangedBy'], 'integer'],
            [['prefix', 'RecordDate','memberName', 'FullName', 'ChangedDate','recDate','sponsor0.sponsorship.membershipNo'], 'safe'],
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
        return array_merge(parent::attributes(),['sponsor0.sponsorship.membershipNo']);
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
        $query = Sponsorship::find()->orderBy('RecordDate DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('sponsor0.sponsorship As sp');
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //
        //$query->joinWith('member0');
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'member' => $this->member,
            'status' => $this->status,
            'membershipNo' => $this->membershipNo,
            'parent' => $this->parent,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'position' => $this->position,
            'sponsor' => $this->sponsor,
            'level' => $this->level,
            'Rank' => $this->Rank,
            'prefPosition' => $this->prefPosition,
            'RecordBy' => $this->RecordBy,
            'RecordDate' => $this->RecordDate,
            'ChangedBy' => $this->ChangedBy,
            'ChangedDate' => $this->ChangedDate,
        ]);

        $query->andFilterWhere(['like', 'prefix', $this->prefix])
                ->andFilterWhere(['like', 'memberName', $this->member])
                ->andFilterWhere(['like', 'sp.membershipNo', $this->getAttribute('sponsor0.sponsorship.membershipNo')]);

        return $dataProvider;
    }
    
    public function getStatsDataProvider()
    {
        $cnt = Yii::$app->db
                ->createCommand('SELECT COUNT(member) FROM sponsorship')
                ->queryScalar();
        //$cnt = "SELECT count('*') from sponsorship";
        $sql="SELECT CONCAT_WS(' ',firstName,otherNames,Surname) AS FullName ,membershipNo,member,member m1,email, level l1,
                phoneNo, sponsor as sp1,
                (SELECT member FROM sponsorship WHERE parent = m1 AND position = 1 AND level= (l1+1)) AS lftChild,
                (SELECT lft FROM sponsorship WHERE member = lftChild ) AS lftChildLft,
                (SELECT rgt FROM sponsorship WHERE member = lftChild ) AS lftChildRgt,
                (SELECT member FROM sponsorship WHERE parent = m1 AND position = 2 AND level= (l1+1)) AS rgtChild,
                (SELECT lft FROM sponsorship WHERE member = rgtChild ) AS rgtChildLft,
                (SELECT rgt FROM sponsorship WHERE member = rgtChild ) AS rgtChildRgt,
                (SELECT count(`sponsor`) FROM `sponsorship` WHERE `sponsor`= m1 and sponsor <> member) AS NoSponsored,
                (SELECT count(`sponsor`) FROM `sponsorship` WHERE `sponsor`= m1 and position = 1) AS SponsoredLft,
                (SELECT count(`sponsor`) FROM `sponsorship` WHERE `sponsor`= m1 and position = 2) AS SponsoredRgt,
                (SELECT count('member') FROM sponsorship WHERE lft>= lftChildLft and rgt<= lftChildRgt) as TeamLft,
                (SELECT count('member') FROM sponsorship WHERE lft>= rgtChildLft and rgt<= rgtChildRgt) as TeamRgt
                FROM `sponsorship` s 
                LEFT JOIN people p  on p.id=s.member  
                LEFT JOIN user u  on p.id=u.peopleId
                WHERE 1 ";
        return  new \yii\data\SqlDataProvider([
            'sql'=>$sql,
              'totalCount'=>$cnt
                ]);
    }
}
