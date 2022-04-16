<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\modules\dashboard\models;

use Yii;
use yii\base\Model;
use\yii\helpers\ArrayHelper;
use yii\helpers\Html;



/**
 * Description of Membership
 *
 * @author Apache1
 */
class Membership extends Model {
    public $memberName;
    public $memberNo;
    public $memberId;
    public $memberRank;
    public $packageName;
    public $packId;
    public $status;
    public $expiryDate;
    public $statusEndDate;
    public $level;
    public $peopleId;
    public $sponsorName;
    public $joinDate;
    public $sponsorNo;
    public $sponsorRank;
    public $sponsorId;
    public $noSponsored;
    public $noSponsoredLft;
    public $noSponsoredRgt;
    public $parentName;
    public $parentNo;
    public $placement;
    public $parentRank;
    public $parentId;
    public $bottomLeft;
    public $bottomRight;
    public $lftChildMemNo;
    public $rgtChildMemNo;
    public $parents = array(array());
    public $levelCount = array();
    public $showArray = array(array());
    public $bTreeList = array(array());
    public $tempList = array(array());
    public $bTreeMembers ;
    public $SponsorBonusPending;
    public $SponsorBonusPaid;
    public $pointsPending;
    public $pointsBal;
    public $pointsBalSide;
    public $pointsPendLvl1;
    public $pointsPendLvl2;
    public $pointsPaid;
    public $cyclesPending;
    public $cyclesPaid;
    public $binaryBonusPending;
    public $binaryBonusPaid;        
    public $binaryLftPending;
    public $binaryRgtPending;
    public $matchingAll;
    public $matchingToday;
    public $matchingYesterday;
    public $matchingThisWeek;
    public $matchingLastWeek;
    public $matchingThisMonth;
    public $matchingLastMonth;
    public $matchingToWalletPending;
    public $walletBal;
    public $availableTrxFunds;
    public $theDate ;
            

    
    
    public function startup($memberId)
    {
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('people p')
                ->leftJoin('user u','u.peopleId=p.id')
                 ->leftJoin('sponsorship s','s.member=p.id')
                 ->leftJoin('statuses t','t.id=s.status')
                ->leftJoin('ranks r', 'r.id=s.rank')
                ->where(['p.id'=>$memberId])
                ->one();
              
        $this->setMemberValues($myqry);
        $this->parents[1][]=$this->peopleId;
        //$this->getChildParticulars();
        $this->getLevelParts();
    }
    
    
    private function setMemberValues(&$myqry)
    {
        $theDate= date('Y-m-d H:i:s');
        $memberDetails=Yii::$app->memberdetails;
        $this->memberName = $myqry['firstName'].' '.$myqry['surname'];
        $this->memberNo =  $myqry['membershipNo'];
        $this->memberId = $myqry['member'];
        $this->memberRank = $myqry['rankName'];
        $packName = Packages::find()->where(['id'=>$memberDetails->getMemberHistory($this->memberId)])->one();
        $this->packageName= $packName['packName'];
        $this->packId = $packName['id'];
        $this->level = $myqry['level'];
        $this->status = $myqry['Status'];
        $this->statusEndDate = $memberDetails->getMembershipHistory($this->memberId,date('Y-m-d H:i:s'));
        $this->expiryDate = $memberDetails->getMembershipHistory($this->memberId,date('Y-m-d H:i:s'),5);
        $this->peopleId = $myqry['member'];
        $this->sponsorId =  $myqry['sponsor'];
        $this->joinDate = Yii::$app->formatter->asDate($memberDetails->getMemberPartsUsingPeopleId($this->peopleId,12),'medium');
        $this->sponsorName = $memberDetails->getMemberPartsUsingPeopleId($this->sponsorId,6);
        $this->sponsorNo = $memberDetails->getMemberPartsUsingPeopleId($this->sponsorId);
        
        $this->noSponsoredLft=$memberDetails->sponsoringDetails($this->memberId,$theDate,3);
        $this->noSponsoredRgt=$memberDetails->sponsoringDetails($this->memberId,$theDate,4);
        $this->noSponsored = $memberDetails->sponsoringDetails($this->memberId,$theDate);
        $this->parentId = $myqry['parent'];
        $this->bottomLeft = $memberDetails->extremeSide($this->memberId,1);
        $this->bottomRight = $memberDetails->extremeSide($this->memberId,2);
        $this->placement =  $memberDetails->getMemberPartsUsingPeopleId($this->memberId,13);
        $this->parentName = $memberDetails->getMemberPartsUsingPeopleId($this->parentId,6);
        $this->parentNo = $memberDetails->getMemberPartsUsingPeopleId($this->parentId);
        // children
        $this->lftChildMemNo = $memberDetails->getMemberPartsUsingPeopleId($this->bottomLeft,1);
        $this->rgtChildMemNo = $memberDetails->getMemberPartsUsingPeopleId($this->bottomRight,1);
        //Referral Points
        $this->pointsPendLvl1= $memberDetails->showReferralPoints($this->memberId,1,4);
        $this->pointsPendLvl2 = $memberDetails->showReferralPoints($this->memberId,2,4);
        $this->pointsPending = $this->pointsPendLvl1+$this->pointsPendLvl2;
        $this->pointsPaid = $memberDetails->showReferralPoints($this->memberId,1,2);
        $this->pointsBal = $memberDetails->getBalPoints($this->memberId/*,$optn=11=amount; 2=whichSide*/);
        $this->pointsBalSide = $memberDetails->getBalPoints($this->memberId,2/*1=amount; 2=whichSide*/);
        //referral earnings
        $this->SponsorBonusPending = $memberDetails->getReferralBonusParts($this->memberId);
        $this->SponsorBonusPaid = $memberDetails->getReferralBonusParts($this->memberId,2);
        //cycles
        $this->cyclesPending = $memberDetails->teamBonusParts($this->memberId,3);
        $this->cyclesPaid = $memberDetails->teamBonusParts($this->memberId,4);//($this->memberId,2);
        $this->binaryLftPending = $memberDetails->showCyclePointsBal($this->memberId,3);
        $this->binaryRgtPending = $memberDetails->showCyclePointsBal($this->memberId,4);
        $this->binaryBonusPending = $memberDetails->teamBonusParts($this->memberId);
        $this->binaryBonusPaid = $memberDetails->teamBonusParts($this->memberId,2);
        //matching
        $this->matchingAll = $memberDetails->displayMatchingBonus($this->memberId, date('Y-m-d H:i:s'));
        $this->matchingToday = $memberDetails->displayMatchingBonus($this->memberId, date('Y-m-d H:i:s'),2);
        $this->matchingYesterday = $memberDetails->displayMatchingBonus($this->memberId, date('Y-m-d H:i:s'),3);
        $this->matchingThisWeek = $memberDetails->displayMatchingBonus($this->memberId, date('Y-m-d H:i:s'),4);
        $this->matchingLastWeek = $memberDetails->displayMatchingBonus($this->memberId, date('Y-m-d H:i:s'),5);
        $this->matchingThisMonth = $memberDetails->displayMatchingBonus($this->memberId, date('Y-m-d H:i:s'),6);
        $this->matchingLastMonth = $memberDetails->displayMatchingBonus($this->memberId, date('Y-m-d H:i:s'),7);
        $this->matchingToWalletPending = $memberDetails->displayMatchingBonus($this->memberId, date('Y-m-d H:i:s'),8);
        $this->walletBal= $memberDetails->getWalletBal($this->memberId);
        $this->availableTrxFunds  = $memberDetails->checkTransferredFunds($this->memberId);
    }
    
    
    public function getLevelParts(){
        
        $extractIdx=0;// keeps track of total no of members
        $myqry = (new \yii\db\Query())
                ->from('sponsorship s')
                ->leftJoin('people p','p.id= member')
                ->leftJoin('ranks r', 'r.id=s.rank')
                ->orderBy(['membershipNo'=>SORT_ASC]);
        for( $i=0;$i<Yii::$app->params['maxLevels'];$i++ ){// $i keeps track of levels
            $relLevel=$i+1;
            $parentArr = $this->parents[$relLevel];
//            
            
            if(count($parentArr)==0)break;//Stop if no more children
            $this->levelCount[$relLevel] = count($parentArr);
            $levelItems = $myqry->select('*')
                            ->where(['level'=> ($this->level)+$relLevel])
                            ->andWhere(['IN','parent',$parentArr])
                            ->all();
            // extract required items
            $this->extractItems($levelItems,$i,$extractIdx);
            //get member No
            if($i==0){
                $this->parents[0]= $this->peopleId;
            }
            //get parents for next level
            $this->parents[$relLevel+1]=ArrayHelper::getColumn($levelItems,'member'); 
             //prepare next level 
            
        }        
    }
    
    public function extractItems($arr,$itemcnt,&$membercount)
    {
        
        foreach($arr as $i=>$member){
            if($membercount==0){
                $memberArr = array('v'=>$this->memberNo, 'f'=>'<img src="images/person15.jpg" /><br  /><strong>You</strong><br  />');
                $this->showArray[$membercount]= array($memberArr,' ',$this->memberName);
                $membercount++;
                //continue;
            }
            $firstArr=array('v'=>$member['membershipNo'], 'f'=>'<img src="images/person15.jpg" /><br  /><strong>'.$member['surname'].'</strong><br  />');
            $membername = $member['firstName'].' ' .$member['surname'];
            
            $this->showArray[$membercount]=array($firstArr,Yii::$app->memberdetails->getMemberPartsUsingPeopleId($member['parent']),$membername);
            $membercount ++; 
            
        }
        
    }
    
    /**
     * @
     * @param type $node
     */
    private function buildList($node/*MemberId*/) {
        $stack = new stack();
        $this->bTreeMembers=0;
        $curNode=$node;
        $otherNode=0;
        
        // select members from sponsorship whose parent is node
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('sponsorship s')
                ->leftJoin('people','p.id = s.member')
                ->leftJoin('ranks r','r.id = s.Rank')
                ->where(['parent'=>$curNode]);
        $noOfChildren =$this->getChildCount($myqry);
       
        do{
            if($noOfChildren>1 ){//there is a right child
                
                $curNode=$this->extractMemberDetails($myqry,'L');
                //put right leg in a temporary Array and put the pointer on the stack
                $stack->push($this->extractTempDetails($myqry));
            }elseif($this->checkLeftChild($myqry)){
                $curNode=$this->extractMemberDetails($myqry,'L');
            }elseif($this->checkRightChild($myqry)){
                $curNode=$this->extractMemberDetails($myqry,'R');
            }else{// no children
                //copy the temporary list
                $curNode=$stack->pop();
                $this->bTreeList[]=$this->tempList[$curNode];
            }
        }while(!$stack->empty());
        
    }
    
    private function getChildCount($myqry) {
        
        return $myqry->count();
    }
    
    private function checkLeftChild($myqry){
        if($myqry->andWhere(['lft'=>1])->count()>0)
        {return true;}
        else 
        {return false;}
            
       
    }
    private function checkRightChild($myqry){
        if($myqry->andWhere(['rgt'=>1])->count()>0)
        {return true;}
        else 
        {return false;}
            
       
    }
    private function getRightChildNode($myqry){
        $theQry=$myqry->andWhere(['rgt'=>1])->one();
        return $theQry['member'] ;
    }
    /*
     *   items required
     *   person.Id, membershipNo,name,whether Left or Right, parentNode, Rank
     */
    private function extractMemberDetails($myqry,$side){
        if($side=='L'){
            $mySelection= $myqry->andWhere(['lft'=>1])->one();
        }elseif($side=='R'){
            $mySelection= $myqry->andWhere(['rgt'=>1])->one();
        }
        $this->bTreeList[]=array('pid'=>$mySelection['member'],
                                    'memberNo'=>$mySelection['membershipNo'],
                                    'memberName'=>$mySelection['surname'],
                                    'parentNo'=>$mySelection['parent'],
                                    'side'=> $side,
                                    'rank'=> $mySelection['rankName']
                                    );
        return $mySelection['member'];
    }
    private function extractTempDetails($myqry,$side='R'){
        if($side=='L'){
            $mySelection= $myqry->andWhere(['lft'=>1])->one();
        }elseif($side=='R'){
            $mySelection= $myqry->andWhere(['rgt'=>1])->one();
        }
        $this->tempList[$mySelection['member']]=array('pid'=>$mySelection['member'],
                                    'memberNo'=>$mySelection['membershipNo'],
                                    'memberName'=>$mySelection['surname'],
                                    'parentNo'=>$mySelection['parent'],
                                    'side'=> $side,
                                    'rank'=> $mySelection['rankName']
                                    );
        return $mySelection['member'];
    }
}
