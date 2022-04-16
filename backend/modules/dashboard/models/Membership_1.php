<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\modules\dashboard\models;

use Yii;
use yii\base\Model;


/**
 * Description of Membership
 *
 * @author Apache1
 */
class Membership extends Model {
    public $memberName;
    public $memberNo;
    public $memberRank;
    public $status;
    public $level;
    public $peopleId;
    public $sponsorName;
    public $sponsorNo;
    public $sponsorRank;
    public $sponsorId;
    public $parentName;
    public $parentNo;
    public $parentRank;
    public $parentId;
    public $children = array( array(array()));
    public $childrenPerLevel = array();
    
    public function init()
    {
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('people p')
                ->leftJoin('user u','u.peopleId=p.id')
                 ->leftJoin('sponsorship s','s.member=p.id')
                 ->leftJoin('statuses t','t.id=s.status')
                ->leftJoin('ranks r', 'r.id=s.rank')
                ->where(['u.id'=>Yii::$app->user->id])
                ->one();
              
        $this->setMemberValues($myqry);
        //$this->getChildParticulars();
    }
    
    private function getChildrenPerLevel($level,$parent, $optn = 1 /*1= count; 2= get values*/)
    {
        
        $relLevel=$level-$this->level;
        $myqry = (new \yii\db\Query())
                
                ->from('sponsorship s')
                ->leftJoin('people p','p.id= member')
                ->leftJoin('ranks r', 'r.id=s.rank')
                ->where('level = :level and parent=:parent',[':level'=> $level,':parent'=>$parent]);
                //->asArray();
        switch($optn) {
            case 1://count level 1
                return $myqry->select('count( *)')->one();
            case 2:
                $myqry->select('*')->all();
                
                foreach ($myqry->each() as $i=>$child)  {
                    $this->children[$child[$relLevel]][$i]['member'] = $child['member'];
                    $this->children[$child[$relLevel]][$i]['memberNo'] = $child['membershipNo'];
                    $this->children[$child[$relLevel]][$i]['status'] = $child['status'];
                    $this->children[$child[$relLevel]][$i]['fullName'] = $child['firstName'].' '.$child['surname'];
                    $this->children[$child[$relLevel]][$i]['parent'] = $child['parent'];
                    $this->children[$child[$relLevel]][$i]['sponsor'] = $child['sponsor'];
                    $this->children[$child[$relLevel]][$i]['rank'] = $child['rankName'];
                }
                break;
        }
        
    }
    private function getChildParticulars(){
        $curLevel = $this->level+1;
        $curParent = $this->peopleId;
        $relLevel = $curLevel-$this->level;
        for($i=0;$i<Yii::$app->params['maxLevels'];$i++){
            if($relLevel==1){
                $this->updateChildren($curLevel,$relLevel,$curParent);
            }else{//$relLevel>1
                $this->childrenPerLevel[$relLevel]=0;
                //get childre Count for this level
                $prevLevelCount= $this->childrenPerLevel[$relLevel-1];
                for($j=0;$j<$prevLevelCount;$j++){
                    $curParent = $this->children[$child[$relLevel-1]][$i]['member'];
                    $this->childrenPerLevel[$relLevel]+= $this->getChildrenPerLevel($curLevel,$curParent);
                }
                if($this->childrenPerLevel[$relLevel]==0)break;
                
                for($k=0;$k<$this->childrenPerLevel[$relLevel-1];$k++)
                {
                    $this->updateChildren($curLevel,$relLevel,$this->children[$child[$relLevel]][$k]['member']);
                }
            }
           $curLevel +=1;
           $relLevel = $curLevel-$this->level;
        }        
    }
    private function updateChildren($curLevel,$relLevel,$curParent)
    {
        $this->childrenPerLevel[$relLevel] = $this->getChildrenPerLevel($curLevel,$curParent);
                While($this->childrenPerLevel[$relLevel]>0){
                    $this->getChildrenPerLevel($curLevel,$curParent,2);
                }
    }
    private function setMemberValues(&$myqry)
    {
        $this->memberName = $myqry['firstName'].' '.$myqry['surname'];
        $this->memberNo =  $myqry['membershipNo'];
        $this->memberRank = $myqry['rankName'];
        $this->level = $myqry['level'];
        $this->status = $myqry['Status'];
        $this->peopleId = $myqry['member'];
        $this->sponsorId =  $myqry['sponsor'];
        $this->sponsorName = Yii::$app->memberdetails->getMemberPartsUsingPeopleId($this->sponsorId,6);
        $this->sponsorNo = Yii::$app->memberdetails->getMemberPartsUsingPeopleId($this->sponsorId);
        $this->parentId = $myqry['parent'];
        $this->parentName = Yii::$app->memberdetails->getMemberPartsUsingPeopleId($this->parentId,6);
        $this->parentNo = Yii::$app->memberdetails->getMemberPartsUsingPeopleId($this->parentId);
    }
}
