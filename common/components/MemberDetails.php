<?php

namespace common\components;

use Yii;
use yii\base\Component;
use\yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use \common\models\People;


//use backend\modules\genealogy\models\Sponsorship;
/**
 * Description of MemberDetails
 *
 * @author Apache1
 */
class MemberDetails extends Component {

    public $nextlft;
    public $nextParent;
    public $nextLvl;
    public $nextPosition;
    public $msg;

    /**
     * 
     * @return type array with people.id of members
     */
    public function getMembersList() {
        $arr = (new \yii\db\Query())
                ->select(['member'])
                ->from('sponsorship')
                ->all();
        return ArrayHelper::getColumn($arr, 'member');
    }

    public function getProspectiveMembers() {
        $arr = (new \yii\db\Query())
                ->select(['id'])
                ->from('people')
                ->where(['NOT IN', 'id', $this->getMembersList()])
                ->all();
        return ArrayHelper::getColumn($arr, 'id');
    }

    /**
     * 
     * Create a random memberNo
     * @return type
     */
    public Function getNextMemberNo() {
        //$val = Yii::$app->db->createCommand('select MAX(membershipNo) From sponsorship')->queryScalar();
        $val = 1000000;
        $unique = false;
        do {
            $val = random_int(1000001, 9999999);
            if ($this->isUnique($val))
                $unique = true;
        }while ($unique == false);
        return $val;
    }

    /**
     * confirms  $anInt is unique in sponsorship table
     * 
     * @param type $anInt
     * @return boolean
     */
    Private function isUnique($anInt) {
        $aVal = (new \yii\db\Query())
                ->select(['count(*)'])
                ->from('sponsorship')
                ->where(['membershipNo' => $anInt])
                ->count();
        if ($aVal > 0)
            return false;
        return true;
    }

    public function getCurrentMemberDetails($optn) {
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('people p')
                ->leftJoin('user u', 'u.peopleId=p.id')
                ->leftJoin('sponsorship s', 's.member=p.id')
                ->leftJoin('statuses t', 't.id=s.status')
                ->where(['u.id' => Yii::$app->user->id])
                ->one();
        switch ($optn) {
            case 1:// Member Name
                return $myqry['firstName'] . ' ' . $myqry['surname'];
                break;
            case 2://Member No
                return $myqry['membershipNo'];
            case 3:// Status Name
                return $myqry['Status'];
            case 4:
                return $myqry['sponsor'];
            case 5:
                return $myqry['parent'];
            default:
                return 'try another option';
        }
    }

    /**
     * Gets sponsorMemberNo saved upon registration
     * @return type int  = sponsorNo
     */
    public function getSponsorNo() {
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('tempsponsor')
                ->where(['member' => Yii::$app->user->id])
                ->one();
        return $myqry['sponsor'];
    }

    /**
     * creates a new member in sponsorship table from details in tempSponsor
     * @param type $peopleId
     */
    public function addMember($peopleId) {
        $session = Yii::$app->session;
        try {
            //confirm the parent
            //$parent = $this->confirmParent($this->getMemberPartsUsingMemberNo($sponsorMemberNo));
            //add 1 to the parent level
            //$level = $this->getMemberPartsUsingPeopleId($parent,4)+1;
            $tempSponsorNo = $this->getTempSponsorDetails($peopleId); //sponsor's membershipNo
            $tempSponsor = $this->getMemberPartsUsingMemberNo($tempSponsorNo);
            $parent = $this->getNextParent($tempSponsor);
            $db = Yii::$app->db;
            $db->createCommand()->insert('sponsorship', [
                        'member' => $peopleId,
                        'membershipNo' => $this->getNextMemberNo(),
                        'sponsor' => $tempSponsor,
                        'parent' => $parent,
                        'lft' => $this->insertChild($parent),
                        'rgt' => $this->toggle($this->nextlft),
                        'status' => 1, //Inactive
                        'Rank' => 1,
                        'level' => $this->nextLvl,
                        'RecordDate' => date('Y-m-d H:i:s'),
                        'RecordBy' => Yii::$app->user->id,
                    ])
                    ->execute();
        } catch (\yii\db\Exception $e) {
            $session->setFlash('error', 'Unable to save sponsor details: ' . $e->getMessage());
        }
    }

    public function getTempSponsorDetails($userid, $optn = 1) {
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('tempsponsor')
                ->where(['member' => $userid])
                ->one();
        switch ($optn) {
            case 1://sponsor
                $retval = $myqry['sponsor'];
                break;
            case 2:
                $retval = $myqry['lft'];
                break;
            case 3:
                $retval = $myqry['parent'];
                break;
            case 4://Parenting method to be used
                $retval = $myqry['parMethod'];
                break;
            default :
                $retval = 0;
        }
        return $retval;
    }
    public function getTempSponsorDetails2($memberid, $optn = 1) {
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('tempsponsor t')
                ->leftJoin('user u','t.member=u.id')
                //->leftJoin(people p)
                ->where(['u.peopleId' => $memberid])
                ->one();
        switch ($optn) {
            case 1://sponsor
                $retval = $myqry['sponsor'];
                break;
            case 2:
                $retval = $myqry['lft'];
                break;
            case 3:
                $retval = $myqry['parent'];
                break;
            default :
                $retval = 0;
        }
        return $retval;
    }

    /**
     * 
     * @param type $peopleId
     * @param type $optn
     * @return int
     */
    public function getMemberPartsUsingPeopleId($peopleId, $optn = 1) {
        $this->msg = '<strong>getMemberPartsUsingPeopleId </strong><br>';
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('sponsorship s')
                ->leftJoin('people p', 'p.id = s.member')
                ->leftJoin('ranks r', 'r.id = s.rank')
                //->leftJoin('user u',' u.peopleId = p.id') //use userdetails->getUserParts($memberId,$optn) instead
                ->where(['s.member' => $peopleId])
                ->one();
        switch ($optn) {
            case 1:
                $this->msg .= 'membershipNo';
                return $myqry['membershipNo'];

            case 2://parent peopleId
                $this->msg .= 'parent: ' . $myqry['parent'];
                return $myqry['parent'];

            case 3://sponsor peopleId
                $this->msg .= 'sponsor: ' . $myqry['sponsor'];
                return $myqry['sponsor'];

            case 4://member level
                $this->msg .= 'level: ' . $myqry['level'];
                return $myqry['level'];

            case 5://member rank
                $this->msg .= 'rankName: ' . $myqry['rankName'];
                return $myqry['rankName'];
            case 6:
                $this->msg .= 'firstName: ' . $myqry['firstName'];
                return $myqry['firstName'] . ' ' . $myqry['surname'];
            case 7://rgt
                $this->msg .= 'rgt: ' . $myqry['rgt'];
                return $myqry['rgt'];
            case 8://lft
                $this->msg .= 'lft: ' . $myqry['lft'];
                return $myqry['lft'];
            case 9:// get position
                $this->msg .= 'position: ' . $myqry['position'];
                return $myqry['position'];
            case 10:// get status
                $this->msg .= 'status: ' . $myqry['status'];
                return $myqry['status'];
            case 11://member rankId
                $this->msg .= 'rankId: ' . $myqry['Rank'];
                return $myqry['Rank'];
            case 12://Join Date
                $this->msg .= 'RecordDate: ' . $myqry['RecordDate'];
                return $myqry['RecordDate'];
            case 13:
                $this->msg .= 'Preferred Position: ' . $myqry['prefPosition'];
                return $myqry['prefPosition'];
            case 14:
                $this->msg .= 'Phone No: ' . $myqry['phoneNo'];
                return $myqry['phoneNo'];
            case 15:
                $this->msg .= 'CountryId: ' . $myqry['nationality'];
                return $myqry['nationality'];

            default:
                $this->msg .= "Unavailable option";
                return 0;
        }
    }

    public function getMemberPartsUsingMemberNo($memberNo, $optn = 1) {
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('sponsorship s')
                ->leftJoin('ranks r', 'r.id=s.rank')
                ->where(['membershipNo' => $memberNo]);
                
        switch ($optn) {
            case 1:// people.id 
                $myqry = $myqry->one();
                return $myqry['member'];

            case 2://parent peopleId
                $myqry = $myqry->one();
                return $myqry['parent'];

            case 3://sponsor peopleId
                $myqry = $myqry->one();
                return $myqry['sponsor'];

            case 4://member level
                $myqry = $myqry->one();
                return $myqry['level'];

            case 5://member rank
                $myqry = $myqry->one();
                return $myqry['rankName'];
            case 6://list all children
                $myqry = $myqry->one();
                return $this->listMembers($myqry['lft'],$myqry['rgt']);
            default:
                return 0;
        }
    }

    public function confirmParent($sponsor/*             * typeOf people.id */) {
        //select level+1 get no of children parented by sponsor
        //if children are more than 6 [Allowed cildren No Per Level Per Parent] then go to next lower level
        //else return next child sponsored at this level
        return $sponsor;
    }

    private function toggle($mybool) {
        return $mybool == 0 ? 1 : 0;
    }

    public function isRegistered($memberId, $optn = 1) {
        $mycount = (new \yii\db\Query())
                ->select('*')
                ->from('inpayments i')
                ->where(['member' => $memberId, 'ptype' => 1, 'confirmed' => 1]);
        switch ($optn) {
            case 1:
                return $mycount->count();
            case 2: //if approved 1
                return $this->toggle($mycount->andWhere(['confirmDate' =>  Null])->count());
            default:
                return -1;
        }
    }

    public function isAMember($memberId) {
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('sponsorship ')
                ->where(['member' => $memberId])
                ->one();
        return $myqry['membershipNo'];
    }

    public function getNextParent($sponsor/* from peopleId */) {
        //check if sponsor has left and right
        //get all parents
        $msg = '<strong>GetNextParent</strong><br>';
        if(($lft= $this->getMemberPartsUsingPeopleId($sponsor,8)+1)==($rgt= $this->getMemberPartsUsingPeopleId($sponsor,7))){
            $this->nextParent= $sponsor;
            $this->nextPosition = $this->getPosition();
            
            return $msg;
        }else{
            $allLeafIds= $this->getAllLeaves($sponsor);
            $allParentIds= $this->getAllLeaves($sponsor,2);
            $found = false;
            for($i=0;$i<count($allParentIds);$i++){
                if($this->getChildren($allParentIds[$i])<2){//count of children is less than 2
                    $this->nextParent= $allParentIds[$i];
                    $this->nextPosition = $this->getPosition();
                    $found=true;
                    break;
                }
            }
            if(!$found){
                $this->nextParent= /*is_array($allLeafIds)? $allLeafIds[0]:****/$allLeafIds;
                $this->nextPosition = $this->getPosition();
            }   
        }
        
        return $msg;
    }
    
   /**
    * 
    * @param type $sponsor
    * @param type $parent
    * @return type
    */ 
   public function getParent($sponsor, $parent/* >0 if parent specified*/,$side) {
       
       
            $parent=$parent>0?$parent:$sponsor;//ensure parent is valid else make it same as sponsor
           //confirm suitabilty of parent
           //parent must be in sponsors tree and have less than two children
           if(!$this->confirmSuitableParent($sponsor,$parent)){
           //if not suitable thenlook for suitable parent using parent
                $retval=$this->nextParent=$this->searchParent($parent,$side);
           }else{
                $retval=$this->nextParent=$this->searchParent($sponsor,$side);
           }
       
       return $retval;
   }
   
   /**
    * 
    * @param type $parent
    * @return type
    */
   protected function searchParent($parent,$side){
       //get all leaves + parents in date order
       $arr1= $this->getAllLeaves($parent,$side);
       $arr2 = $this->getAllLeaves($parent,$side,2);
       $arr3 = ArrayHelper::merge($arr2, $arr1);
       $arr3 = array_unique($arr3);
      
       //get first that has  < two children
       foreach($arr3 as $myparent){
           if($this->getChildren($myparent)<2){
               
               return $myparent;
           }
       }
       return -1;//if parent not found.
   }
   
   /**
    * 
    * @param type $sponsor
    * @param type $parent
    * @return boolean if parent is suitable return true; else false
    */
   public function confirmSuitableParent($sponsor,$parent){
       $retval=true;
       if($this->getChildren($parent)>1){//parent has less than two children
           $retval==false;
       }elseif(!(ArrayHelper::isIn ($parent,$this->getAllLeaves($sponsor,3)/*array of all members under sponsor*/))){
           $retval==false;
       }
       return $retval;
   }
   
   public function getNextLft($parent){
       //count children for parent
       $childrenCnt =$this->getChildren($parent);
       //if childCount=0 or child is on left take right take $side
       if($childrenCnt==0 ||$this->getChildren($parent, 2)==1||$this->getMemberPartsUsingPeopleId($parent, 9)==0){
           $retval = $this->nextlft = $this->getMemberPartsUsingPeopleId($parent,7);
       }else{//existing child is on right 
           $retval = $this->nextlft =  $this->getChildren($parent, 3);
       }
       return $retval;
   }
   
    public function checkChildrenNo($parent) {
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('sponsorship ')
                ->where(['parent' => $parent]);
        if ($myqry->count() == 0) {
            // select left or right randomly
            $this->nextLft = random_int(0, 1);

            $this->nextParent = $parent;
            $isAllocated = 1;
        } elseif ($myqry->count() == 1) {//count is 1
            $mychildren = $myqry->one();
            $this->nextlft = $this->toggle($mychildren['lft']);
            $this->nextParent = $parent;
            $isAllocated = 1;
        } else {//count is 2
            $isAllocated = 0;
        }
        return $isAllocated;
    }

    public function getParentParticulars($parent, $optn = 1) {
        //add 4to the left and anything greter than that in lft and rgt columns
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('sponsorship ')
                ->where(['parent' => $parent]);
        switch ($optn) {
            case 1://count of children
                return $myqry->count();
            case 2://this is parent member no
                $mymember = $myqry->one();
                return $mymember['member'];
            case 3://get rgt
                $mymember = $myqry->one();
                return $mymember['rgt'];
            case 4://get lft
                $mymember = $myqry->one();
                return $mymember['lft'];
            case 5://get rgt
                $mymember = $myqry->one();
                return $mymember['level'];
            default:
                return -1;
        }
    }
    /**
     * 
     * @param type $myId
     * @param type $parent
     * @param type $sponsor
     * @param type $side
     * @return string
     * @throws \Exception
     */
    public function addChild($myId, $parent, $sponsor, $side = 1/* 0=root;1=letf*; 2=right */) {
        try {
            $msg = '<strong>AddChild</strong><br>';
            //$msg .= 'MemberId: ' . $myId . '; Parent: ' . $parent . '; Sponsor: ' . $sponsor . '; Side: ' . $side . '<br>';
            //if first
            
            if ($this->confirmEmptySponsor() == 0) {
                $this->insertChild($myId, $myId, 1, 0);
            } else {
                $this->adjustAndInsertChild2($myId, $parent, $sponsor,$side );
                //confirm that parent is not full
                //$childrenNo = $this->getChildren($parent);
               /* if ($childrenNo == 0 && $side == 1) {// No Existing  children 
                    $msg .= 'No of children: 0; Child to be put on Left' . '<br>';

                    $msg .= $this->adjustAndInsertChild($myId, $parent, $sponsor,$side , 1/* 1=yes 0=no );
                } elseif ($childrenNo == 0 && $side == 2) {
                    $msg .= 'No of children: 0; Child to be put on Right'.'<br>';
                    $msg .= $this->adjustAndInsertChild($myId, $parent, $sponsor,$side , 0/* 1=yes 0=no );
                } elseif ($childrenNo == 1 && $this->getChildren($parent, 2) == 1) {
                    //confirm child is left
                    $msg .= 'No of children: 1; Existing child is on left' . '<br>';
                    $msg .= $this->adjustAndInsertChild($myId, $parent, $sponsor,2 , 1/* 1=yes 0=no );
                } elseif ($childrenNo == 1 && $this->getChildren($parent, 2) == 2) { //existing child is right
                    //get right child's left value
                    $msg .= 'No of children: 1; Existing child is on Right' . '<br>';
                    $msg .= $this->adjustAndInsertChild($myId, $parent, $sponsor,1 , 0/* 1=yes 0=no );
                } else {//already has two children
                    $msg .='Two children aready existing';
                }*/
                
            }
            return $msg;
        } catch (\Exception $e) {
            $msg .= 'Unable to save to sponsorship (3 addChild): ' . $e->getMessage();
            throw $e;
            return $msg;
        } catch (\Throwable $e) {
            $msg .= 'Unable to save to sponsorship (4 addChild): ' . $e->getMessage();
            throw $e;
            return $msg;
        }
        return $msg;
    }

    public function getChildren($parent, $item = 1) {
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('sponsorship ')
                ->where(['parent' => $parent])
                ->andWhere('member!=:parent ' , [':parent'=>$parent]);
        switch ($item) {
            case 1:// count of children
                return $myqry->count();
            case 2:// position of 1st child
                $childparts = $myqry->one();
                return $childparts['position'];
            case 3: // left of existing child
                $childparts = $myqry->one();
                return $childparts['lft'];
            case 4: // rgt of existing child
                $childparts = $myqry->one();
                return $childparts['rgt'];
            case 5://get left child membershipNo
                $lftno=$this->getMemberPartsUsingPeopleId($parent,8);
                $theqry = $myqry->andWhere(['lft'=>$lftno-1])->one();
                if(!empty($theqry)){
                    return $theqry['memberbershipNo'];
                }else{
                    return $this->getMemberPartsUsingPeopleId($parent);
                }
            case 6://get right child membershipNo
                $rgtno=$this->getMemberPartsUsingPeopleId($parent,7);
                $theqry = $myqry->andWhere(['rgt'=>$rgtno+1])->one();
                if(!empty($theqry)){
                    return $theqry['memberbershipNo'];
                }else{
                    return $this->getMemberPartsUsingPeopleId($parent);
                }
            default:
                return -1;
        }
    }
    
    public function getChildParts($parent,$position=1,$item = 1) {
        $parentLvl = $this->getMemberPartsUsingPeopleId($parent,4);
        $parentNo = $this->getMemberPartsUsingPeopleId($parent);
        
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('sponsorship ')
                ->where(['parent' => $parent])
                ->andwhere(['level'=>$parentLvl+1]);
        switch($item){
            case 1://get membershipNo of the child; depends on position
                $result =  $myqry->andWhere(['position'=>$position])->one();
                return empty($result)?$parentNo:$result['membershipNo'];
            case 2://get parent of the child; depends on position
                $result =  $myqry->andWhere(['position'=>$position])->one();
                return empty($result)?$parent:$result['member'];
            case 3://get lft of the child; depends on position
                $result =  $myqry->andWhere(['position'=>$position])->one();
                return $result['lft'];
            case 4://get parent of the child; depends on position
                $result =  $myqry->andWhere(['position'=>$position])->one();
                return $result['rgt'];
            default:
                return -1;
        }
    }
    /* private function confirmSide($member){
      $myqry = (new \yii\db\Query())
      ->select('*')
      ->from('sponsorship ')
      ->where(['member'=>$member])
      ->one();
      return $myqry['position'];

      } */

    public function adjustSponsorship($lft) {
        $msg = '<strong>AdjustSponsorship</strong><br>';
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            //add  2 to values in lft and rgt >= $lft
            $db->createCommand('UPDATE sponsorship SET lft = lft+2 where lft>=:lft')->bindParam(':lft', $lft)->execute();
            //$transaction->commit();
            $db->createCommand('UPDATE sponsorship SET rgt = rgt+2 where rgt>=:rgt')->bindParam(':rgt', $lft)->execute();
            /*$db->createCommand()->update('sponsorship', [
                'rgt' => 'rgt+ 2',
                    ], 'rgt>=:rgt', [':rgt' => $lft])->execute();*/
            $transaction->commit();
            $msg .= 'Lft and Rht successfully adjusted <br>';
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
            return $e->message;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
            return $e->message;
        }
        return $msg;
    }

    public function insertChild($peopleId, $parent, $sponsor, $lft, $position = 1 /* root=0;left=1;right=2 */) {
        $msg = '<strong>insertChild</strong><br>';
        $msg .= 'MemberId: ' . $peopleId . '; ';
        //$msg .= 'Parent: ' . $parent . '; ';
        $msg .= 'Sponsor: ' . $sponsor . '; ';
        $msg .= 'Lft: ' . $lft . '; ';
        $msg .= 'Position: ' . $position . '<br>';
        $session = Yii::$app->session;
        $parent=$parent>0?$parent:$sponsor;//Ensure parent is a +ve no
        //$parent = $this->getNextParent($tempSponsor);
        $db = Yii::$app->db;
        try {
            $db->createCommand()->insert('sponsorship', [
                        'member' => $peopleId,
                        'membershipNo' => $this->getNextMemberNo(),
                        'sponsor' => $sponsor,
                        'parent' => $parent,
                        'lft' => $lft,
                        'rgt' => $lft + 1,
                        'position' => $position,
                        'status' => 2, //Active
                        'Rank' => 1,
                        'level' => $this->getMemberPartsUsingPeopleId($parent, 4) + 1,
                        'RecordDate' => date('Y-m-d H:i:s'),
                        'RecordBy' => Yii::$app->user->id,
                    ])
                    ->execute();
            //$session . setFlash('success', 'Sponsorship successfully saved');
            $msg .= 'Sponsorship successfully saved';
            return $msg;
        } catch (Exception $e) {
            $msg .= 'Unable to save to sponsorship (1): ' . $e->getMessage();
            throw $e;
            return $msg;
        } catch (\Throwable $e) {
            $msg .= 'Unable to save to sponsorship (2): ' . $e->getMessage();
            throw $e;
            return $msg;
        }
    }

    public function confirmEmptySponsor() {
        return (new \yii\db\Query())
                        ->select('*')
                        ->from('sponsorship ')
                        ->where('rgt>lft')//ensures admin has no and is not counted
                        ->count();
    }

    public function getPosition() {
        $msg = '<strong>GetPosition</strong><br>';
        if ($this->getChildren($this->nextParent) == 1) {
            $this->nextPosition = $this->getChildren($this->nextParent, 2) == 1 ? 2 : 1;
            $msg .= 'Side : ' . $this->nextPosition . '<br>';
        } elseif ($this->getChildren($this->nextParent) == 0) {
            $this->nextPosition = 1;
            $msg .= 'Side : ' . $this->nextPosition . '<br>';
        } else {
            $this->nextPosition = -1;
            $msg .= 'Side : ' . $this->nextPosition . ' Parent is full<br>';
        }
        return $msg;
    }
    
    public function getNextPosition($parent,$side) {
        $this->msg = '<strong>GetNextPosition</strong><br>';
        if ($this->getChildren($parent) == 1) {
            $retval = $this->nextPosition = $this->getChildren($parent, 2) == 1 ? 2 : 1;
            $this->msg .= 'Side : ' . $this->nextPosition . '<br>';
        } elseif ($this->getChildren($parent) == 0) {//count of children=0
            $retval = $this->nextPosition = $side==1 ? 1 : 2;
            $this->msg .= 'Side : ' . $this->nextPosition . '<br>';
        } else {
            $retval =$this->nextPosition = -1;
            $this->msg .= 'Side : ' . $this->nextPosition . ' Parent is full<br>';
        }
        return $retval;
    }

    public function adjustAndInsertChild($myId, $parent, $sponsor,$position ,$fromParent/*1=yes; 0=no*/) {
        $msg= '<strong>AdjustAndInsertChild</strong><br>';
        
        switch ($fromParent) {
            case 1:
                $childLft = $this->getMemberPartsUsingPeopleId($parent, 7);
                $this->nextlft = $childLft;
                $msg .= 'Lft : ' . $childLft . '<br>';
                break;
            case 0:
                $msg .= 'Side: Right' . '<br>';
                //get right child's left value
                $childLft = $this->getChildren($parent, 3);
                $this->nextlft = $childLft;
                $msg .= 'Lft : ' . $childLft . '<br>';
                break;
        }
        //update sponsors lft and rgt >= childlft
        $msg .= $this->adjustSponsorship($this->nextlft);
        // insert the child
        $msg .= $this->insertChild($myId, $parent, $sponsor, $this->nextlft, $position);
        return $msg;
    }
    public function adjustAndInsertChild2($myId, $parent, $sponsor,$position ) {
        $msg= '<strong>AdjustAndInsertChild2</strong><br>';
        
        $nextLeft = $this->getNextLft($parent);
        //update sponsors lft and rgt >= childlft
        $msg .= $this->adjustSponsorship($nextLeft);
        // insert the child
        $msg .= $this->insertChild($myId, $parent, $sponsor, $nextLeft, $position);
        return $msg;
    }
    public function getAllLeaves($memberId,$side=1,$optn=1)
    {
        $lftVal = $this->getMemberPartsUsingPeopleId($memberId, 8);
        $rgtVal = $this->getMemberPartsUsingPeopleId($memberId, 7);
        $myqry = (new \yii\db\Query())->select('*')->from('sponsorship ')
                ->where('lft>=:lft', [':lft' => $lftVal])
                ->andWhere('rgt<=:rgt', [':rgt' => $rgtVal]);
        if($side==1) {       
                $myqry=$myqry->orderBy('lft ASC');
        }else{
                $myqry=$myqry->orderBy('lft DESC');
        }
        switch($optn){
            case 1:// Array of all leaf memberIds
                $allLeaves = $myqry->all();
                return ArrayHelper::getColumn($allLeaves, 'member');
            case 2: // Array of all parent memberIds
                $allparents = $myqry->andWhere('member!=:member',[':member'=>$memberId])->all();
                return ArrayHelper::getColumn($allparents, 'parent');
            case 3:// all nodes in sponsors realm
                $wholerealm = $myqry->all();
                return ArrayHelper::getColumn($wholerealm, 'member');
            case 4://list all membershipNos in an array
                $allLeaves = $myqry->all();
                return ArrayHelper::getColumn($allLeaves, 'membershipNo');
        }
    }
    public function getTree($memberId){
        
        $lftVal = $this->getMemberPartsUsingPeopleId($memberId, 8);
        $rgtVal = $this->getMemberPartsUsingPeopleId($memberId, 7);
        $myqry = (new \yii\db\Query())->select('*')->from('sponsorship s')
                ->leftJoin('people p','s.member=p.id')
                ->where('lft>=:lft', [':lft' => $lftVal])
                ->andWhere('rgt<=:rgt', [':rgt' => $rgtVal])
                //->orderBy('lft')
                ->orderBy('lft')
                ->all();
        $stack=array();
        $rgtChildCnt=array();//array that keeps track if there are children on ths Right side
        $dirChange=$level=$mylvl=0;//mylevel keeps track of number of levels
        $treeVal='';
            foreach($myqry as $memberVals){
                $parentId = $this->getMemberPartsUsingPeopleId($memberVals['member'],2);
                $side = $this->getMemberPartsUsingPeopleId($memberVals['member'],9);
                $lft= $this->getMemberPartsUsingPeopleId($memberVals['member'],8);
                $rgt= $this->getMemberPartsUsingPeopleId($memberVals['member'],7);
                $childCnt = $this->getParentParticulars($parentId);
                $rgtChildCnt[$memberVals['member']]=$this->getChildParts($memberVals['member'], 2,2);
                $altDirChange = $dirChange;//previous direction change
                $dirChange = $rgtVal<$rgt?1:0;//level direction vhange
                if($mylvl>=$this->getAppConstant('maxLevels')){
                    continue;//next loop
                }elseif(($memberVals['level']>$level) && ($altDirChange) ){
                    $treeVal=substr($treeVal,0,-5);//remove </li>
                    array_push($stack,"</li>");
                    $treeVal .= "<ul>";
                    array_push($stack,"</ul>");
                    $this->addTreeVals($treeVal,$stack,$memberVals,$memberId);
                    $level=$memberVals['level'];
                    $mylvl++;
                }elseif($memberVals['level']>$level){
                    $treeVal .= "<ul>";
                    array_push($stack,"</ul>");
                    $this->addTreeVals($treeVal,$stack,$memberVals,$memberId);
                    $level=$memberVals['level'];
                    $mylvl++;
                }elseif($memberVals['level']==$level){
                    $treeVal.=array_pop($stack);//close i.e </li>
                    
                    $this->addTreeVals($treeVal,$stack,$memberVals,$memberId);
                }elseif($memberVals['level']<$level){
                    $treeVal.=array_pop($stack);//close i.e </li>
                    //if($childCnt==0){
                        $treeVal.=array_pop($stack);//close i.e </ul>
                    //}
                    //$treeVal.=array_pop($stack);//close i.e </li>
                    $this->addTreeVals($treeVal,$stack,$memberVals,$memberId);
                    //if($rgtChildCnt[$memberVals['member']]==0){
                        $treeVal.=array_pop($stack);//close i.e </li>
                    //}
                    //$treeVal.=array_pop($stack);//close i.e </ul>
                    $level=$memberVals['level'];
                    $rgtVal = $rgt;
                    $mylvl--;
                }
                
            }
            while(count($stack)>0){
                $treeVal.=array_pop($stack);
            }
        return $treeVal;  
    }
    
    public function listMembers($lftVal,$rgtVal)
    {
        $myqry = (new \yii\db\Query())->select('*')->from('sponsorship s')
                //->leftJoin('people p','s.member=p.id')
                ->where('lft>=:lft', [':lft' => $lftVal])
                ->andWhere('rgt<=:rgt', [':rgt' => $rgtVal])
                ->all();
        return ArrayHelper::getColumn($myqry, 'member');
    }
    
    public function addOpen(&$treeVal,&$stack,&$memberVals,$memberId,$side) {
        $treeVal .= "<li>";
                    array_push($stack,"</li>");
        $treeVal .= "<span class='tf-nc treenode'>";
        $treeVal .= "<a href='".  Url::toRoute('/site/join')."&sponsor=".$this->getMemberPartsUsingPeopleId($memberId)."&parent=".$memberVals['membershipNo']."&lft=".$side."'>";
        $treeVal .= "<img src='images/Person4.jpg'";
        $treeVal .= " alt = 'open logo' width ='32px'  height ='32px'"
                ."  title='open'><br>--Open--</span></li>";
    }
    public function confirmOpenChild(&$treeVal,&$stack,&$memberVals,$memberId){
        $side = $this->getMemberPartsUsingPeopleId($memberVals['member'],9);
        $childCnt = $this->getParentParticulars($memberVals['member']);
        if($childCnt==1 && $side=1){
           
                $this->addTreeVals($treeVal,$stack,$memberVals,$memberId);
                $this->addOpen($treeVal,$stack,$memberVals,$memberId);
                //$treeVal.=array_pop($stack);
        }elseif($childCnt==1 && $side==2){
                $this->addOpen($treeVal,$stack,$memberVals,$memberId);
                //$treeVal.=array_pop($stack);
                $this->addTreeVals($treeVal,$stack,$memberVals,$memberId);
                       
        } elseif($childCnt==2 ){
            $this->addTreeVals($treeVal,$stack,$memberVals,$memberId);
        } elseif($childCnt==0){
            $this->addTreeVals($treeVal,$stack,$memberVals,$memberId);
            $treeVal .= "<ul>";
            array_push($stack,"</ul>");
            $this->addOpen($treeVal,$stack,$memberVals,$memberId);
                //$treeVal.=array_pop($stack);
            $this->addOpen($treeVal,$stack,$memberVals,$memberId);
                //$treeVal.=array_pop($stack);
            array_pop($stack);
        }

    }
    
    public function getTree2($memberId){
        
        $lftVal = $this->getMemberPartsUsingPeopleId($memberId, 8);
        $rgtVal = $this->getMemberPartsUsingPeopleId($memberId, 7);
        $myqry = (new \yii\db\Query())->select('*')->from('sponsorship s')
                ->leftJoin('people p','s.member=p.id')
                ->where('lft>=:lft', [':lft' => $lftVal])
                ->andWhere('rgt<=:rgt', [':rgt' => $rgtVal])
                ->orderBy('lft')
                ->all();
        $stack=array();
        $level=$mylvl=0;//mylevel keeps track of number of levels
        $treeVal='';
            foreach($myqry as $memberVals){
                $side = $this->getMemberPartsUsingPeopleId($memberVals['member'],9);
                $childCnt = $this->getParentParticulars($memberVals['member']);
                if($mylvl>=$this->getAppConstant('maxLevels')){
                    continue;//next loop
                }elseif($memberVals['level']>$level){
                    $treeVal .= "<ul>";
                    array_push($stack,"</ul>");
                    if($mylvl>0 && $childCnt==1 && $side==1 ){
                        $this->addTreeVals($treeVal,$stack,$memberVals,$memberId);
                        $this->addOpen($treeVal,$stack,$memberVals,$memberId,2);
                    }elseif($mylvl>0 && $childCnt==1 && $side==2 ){
                        $this->addOpen($treeVal,$stack,$memberVals,$memberId,1);
                        $this->addTreeVals($treeVal,$stack,$memberVals,$memberId);
 
                    }else{
                    $this->addTreeVals($treeVal,$stack,$memberVals,$memberId);
                    }
                    //$this->addOpen($treeVal,$stack,$memberVals,$memberId);
                    
                    $level=$memberVals['level'];
                    $mylvl++;
                }elseif($memberVals['level']==$level){
                    $treeVal.=array_pop($stack);//close i.e </li>
                    
                    $this->addTreeVals($treeVal,$stack,$memberVals,$memberId);
                }elseif($memberVals['level']<$level){
                    $treeVal.=array_pop($stack);//close i.e </li>
                    $treeVal.=array_pop($stack);//close i.e </ul>
                    $this->addTreeVals($treeVal,$stack,$memberVals,$memberId);
                    $level=$memberVals['level'];
                    $mylvl--;
                }
                
            }
            while(count($stack)>0){
                $treeVal.=array_pop($stack);
            }
        return $treeVal;  
    }
    
    public function showArray($memberId)
    {
        $lftVal = $this->getMemberPartsUsingPeopleId($memberId, 8);
        $rgtVal = $this->getMemberPartsUsingPeopleId($memberId, 7);
        $myqry = (new \yii\db\Query())->select('*')->from('sponsorship s')
                ->leftJoin('people p','s.member=p.id')
                ->where('lft>=:lft', [':lft' => $lftVal])
                ->andWhere('rgt<=:rgt', [':rgt' => $rgtVal])
                ->orderBy('lft')
                ->all();
        $outArr=array(array());
        $level=$mylvl=0;//mylevel keeps track of number of levels
        $treeVal='';
        foreach($myqry as $i=>$arr){
            $side = $this->getMemberPartsUsingPeopleId($arr['member'],9);
            $childCnt = $this->getParentParticulars($arr['member']);
            if($i==0){
               $this->transferArr($outArr,$arr,$i); 
            }elseif($childCnt==1 && $side==1 ){
               $this->transferArr($outArr,$arr,$i); 
               $this->addOpenArr($outArr,$arr,$i);
            }elseif($childCnt==1 && $side==2 ){
               $this->addOpenArr($outArr,$arr,$i);
               $this->transferArr($outArr,$arr,$i); 
               
            }
        }
        return $treeVal;
    }
    public function transferArr(&$outArr,&$arr,$i){
            $outArr[$i]['member'] = $arr['member'];
            $outArr[$i]['memberNo'] = $arr['membershipNo'];
            $outArr[$i]['sponsor'] = $arr['sponsor'];
            $outArr[$i]['parent'] = $arr['parent'];
            $outArr[$i]['position'] = $arr['position'];
            $outArr[$i]['level'] = $i;
            $outArr[$i]['fullName'] = $arr['firstName']." ".$arr['surname'];
            $outArr[$i]['shortName'] = $arr['firstName']." ".$arr['surname'];
            $outArr[$i]['status'] = $arr['status'];
            $outArr[$i]['lft'] = $arr['lft'];
            $outArr[$i]['rgt'] = $arr['rgt'];

    }
    public function addOpenArr(&$outArr,&$arr,$i){
            $outArr[$i]['member'] = -1;
            $outArr[$i]['memberNo'] = 0;
            $outArr[$i]['sponsor'] = $arr['sponsor'];
            $outArr[$i]['parent'] = $arr['parent'];
            $outArr[$i]['position'] = $arr['position']==1?2:1;
            $outArr[$i]['level'] = $i;
            $outArr[$i]['fullName'] = "Position Open";
            $outArr[$i]['status'] = 3;
            $outArr[$i]['lft'] = 0;
            $outArr[$i]['rgt'] = 0;

    }
   public function addRegistrationPoints($memberId/*id of sponsored members */,$theDate,$bonusType=1,$level=1)
   {
       $userId = Yii::$app->user->id;
        $db = Yii::$app->db;
        $useful = Yii::$app->useful;
        $sponsor = $this->getMemberPartsUsingPeopleId($memberId, 3);
        /*$spack = 0;
        $mpack = 0;
        $sRank =0;*/
        //$level is relative level
        //$rellevel= 0;
        $myinsert = $db->createCommand();
        switch ($level){
            case 1:
                
                break;
            case 2:
                //get Sponsor of Sponsor
                $sponsor = $this->getMemberPartsUsingPeopleId($sponsor, 3);
                break;
        }
        $sPack = $this->getMembershipHistory($sponsor,$theDate, 4);//$this->getInpaymentItems($sponsor,1/* from pointtrxtypes*/);//
        $mPack = $this->getMembershipHistory($memberId, $theDate,4);//$this->getInpaymentItems($memberId,1/* from pointtrxtypes*/);//
        $sRank = $this->getMembershipHistory($sponsor,$theDate,3);//$this->getMemberPartsUsingPeopleId($sponsor, 11);//;
        
        $mycntrl = $this->getMemberPartsUsingPeopleId($memberId) . $this->getMemberPartsUsingPeopleId($sponsor) . $useful->x_digit($bonusType, 3);
        if($this->confirmNoRegPoints($mycntrl)==0){
        $myinsert->insert('tblpoints', [
            
            'sponsor' => $sponsor,
            'memberFrom' => $memberId,
            'bonusType'=>$bonusType,
            'relLevel'=>$level,
            'points'=> $this->getReferralBonus($bonusType, $sPack, $sRank, $mPack, $level),
            'recordDate' => $theDate,
            'recordBy' => $userId,
            'auditCntrl' => $mycntrl,
        ])->execute();//
        }else{
            $myinsert->update('tblpoints', [

                'sponsor' => $sponsor,
                'memberFrom' => $memberId,
                'bonusType'=>$bonusType,
                'relLevel'=>$level,
                'points'=> $this->getReferralBonus($bonusType, $sPack, $sRank, $mPack, $level),
                'recordDate' => $theDate,
                'recordBy' => $userId,

            ],[
                'auditCntrl' => $mycntrl,
            ]
                    )->execute();//
        }
   }
   
   public function confirmNoRegPoints($auditCntrl)
   {
       $myqry = (new yii\db\Query())
               ->select('*')
               ->from('tblpoints')
               ->where(['auditCntrl'=>$auditCntrl])
               ->one();
       return empty($myqry)?0:1;
   }
   
   /**
    *  Checks if a tblpoints record exits. If so: returns true else: false
    * @param type $memberId
    * @param type $theDate
    * @param type $bonusType
    * @param type $level
    * @return boolean
    */
   public function checkRegistrationPoints($memberId/*id of sponsored members */,$theDate,$bonusType=1,$level=1)
   {
       $db = Yii::$app->db;
       if(!empty((new yii\db\Query())->select('*')->from('tblpoints')->where(['memberFrom'=>$memberId,'relLevel'=>$level,'recordDate'=>$theDate])->one())){
           return true;
       }else{
           return false;
       }
   }
   
   public function getMemberHistory($memberId,$optn=1){
       $myqry = (new \yii\db\Query())
               ->select('*')
               ->from('membershiphistory')
               ->where(['memberId'=>$memberId, 'dateEnd'=>null])
               ->one();
       switch($optn){
           case 1://Package
               return $myqry['packageId'];
           case 2://status
               return $myqry['status'];
           case 3://renk
               return $myqry['rank'];
               
       }
   }
   
   public function addMemberHistory($memberId,$packagenew,$statusnew, $ranknew,$theDate,$trxType=1){
        $db = Yii::$app->db;
        $oldExpiryEate = !empty($this->getMembershipHistory($memberId,$theDate, 5))?$this->getMembershipHistory($memberId,$theDate, 5):Yii::$app->useful->addDateInterval($this->getInpaymentItems($memberId,1/* registration */, 4),$this->getAppConstant('subscriptionPeriod'));
        $anExpiryDate = $oldExpiryEate>$theDate? $oldExpiryEate:$theDate;
        $novelExpiryDate = Yii::$app->useful->addDateInterval($anExpiryDate,30);
        $novelStatusEndDate = Yii::$app->useful->addDateInterval($anExpiryDate,37);
        
        $db->createCommand()
        ->insert('membershiphistory', [
            'memberId' =>$memberId,
            'packageId' => $packagenew,
            'status' => $statusnew,
            'rank'=> $ranknew,
            'dateStart'=>$theDate,
            'statusEndDate' => $novelStatusEndDate,
            'expiryDate'=> $novelExpiryDate,
            'recordBy'=>Yii::$app->user->id,
            'recordDate' => date('Y-m-d H:i:s'),

        ])->execute();       
   }
   /**
    * 
    * @param type $memberId
    * @param type $package
    * @param type $trxType
    */
    
   public function updMemberHistory($memberId,$packagenew,$statusnew, $ranknew,$theDate,$trxType=1){
        $db = Yii::$app->db;
        $oldExpiryEate = !empty($this->getMembershipHistory($memberId, 5))?$this->getMembershipHistory($memberId, 5):Yii::$app->useful->addDateInterval($this->getMembershipHistory($memberId, 6),$this->getAppConstant('subscriptionPeriod'));
        $anExpiryDate = $oldExpiryEate>$theDate? $oldExpiryEate:$theDate;
        $novelExpiryDate = Yii::$app->useful->addDateInterval($anExpiryDate,30);
        $novelStatusEndDate = Yii::$app->useful->addDateInterval($anExpiryDate,37);
        switch($trxType){
            case 1://Registration
                 break;
            case 2://Subscription
                
                //break;
            case 3://upgrade
                // close current first
                $db->createCommand()
                    ->update('membershiphistory',
                            [
                                'dateEnd'=>$theDate,
                                
                                ]
                            ,[
                                'memberId'=>$memberId,
                                'dateEnd'=>Null,
                                
                                ])
                    ->execute();
        }
        //add 30 Days
        
        $db->createCommand()
        ->insert('membershiphistory', [
            'memberId' =>$memberId,
            'packageId' => $packagenew,
            'status' => $statusnew,
            'rank'=> $ranknew,
            'dateStart'=>$theDate,
            'statusEndDate' => $novelStatusEndDate,
            'expiryDate'=> $novelExpiryDate,
            'recordBy'=>Yii::$app->user->id,
            'recordDate' => date('Y-m-d H:i:s'),

        ])->execute();       
   }
   /**
    * Inserts points earned into tblpoints
    * @param type $pack
    * @param type $trxType
    * @param type $optn
    */
   public function getPackageConfig($pack,$trxType=1/* see pointTrxTypes*/,$optn=1){
       $myqry = (new \yii\db\Query())
               ->select('*')
               ->from('packconfig')
               ->where(['packId'=>$pack, 'trxType'=>$trxType])
               ->one();
       switch($optn){
           case 1://amount
               return empty($myqry['amount'])?0:$myqry['amount'];
           case 2:
               return empty($myqry['sponsorPoints'])?0:$myqry['sponsorPoints'];
           case 3:
               return empty($myqry['cyclePoints'])?0:$myqry['cyclePoints'];
       }
       
   }
   public function getReferralBonus($trxType,$sPack,$sRank,$mPack,$level,$optn=1){
       $retval=0;
       $myqry = (new \yii\db\Query())
               ->select('*')
               ->from('referralbonusconfig')
               ->where([ 
                   'trxType'=>$trxType,
                   'sPackage'=> $sPack,
                   //'sRank' => $sRank, //Ignore Rank for now
                   'mPackage'=> $mPack,
                   'level' => $level,
                   ])
               ->one();
       switch($optn){
           case 1:
                return !empty($myqry)?$myqry['amount']:$retval;
           default:
               return $retval;
       }
   }
   public Function addCyclePoints($memberId,$trxType/*register=1; update=3*/,$theDate){
       $db = Yii::$app->db;
       //$transaction = $db->connect;
       //$transaction->begin();
       try{
            $level = $this->getMemberPartsUsingPeopleId($memberId, 4);
            $theparent=$this->getMemberPartsUsingPeopleId($memberId, 2);
            //$theSponsor= $this->getMemberPartsUsingPeopleId($memberId, 3);
            $thepackage = $this->getMembershipHistory($memberId,$theDate,4);
            
            $theChild = $memberId;
            $theStatus= 2; //$this->getMembershipHistory($theChild,$theDate,2);
            $amt = $this->getPackageConfig($thepackage, $trxType, 3);//CyclePoints
            //$amt = (($thepackage==1&&$trxType==1)||($thepackage==2&&$trxType==3))?10:($thepackage==2&&$trxType==1)?20:0; 
            
            while($level>0 && $theChild!== $theparent){
                
                if($amt>0){
                     $db->createCommand()
                      ->insert('tblcycles', [
                          'member' => $theparent,
                          'memberFrom' => $memberId,
                          'lft'=>($this->getMemberPartsUsingPeopleId($theChild, 9)==1)/* Position*/? $amt:0,
                          'rgt'=>($this->getMemberPartsUsingPeopleId($theChild, 9)==2)/* Position*/? $amt:0,
                          'earnDate' => $theDate,
                          //an inactive member shall have their cyclesValid  marked -1 meaning they are not valid for earnings
                          'cyclesValid'=> $theStatus ==1? -1:($theStatus ==2? 1:-1),
                          'comment'=> $theStatus ==1? 'Inactive':'',
                      ])->execute();
                
                     //award cycle earnings
                     //$this->markCyclesInvalid($theChild,$theDate);
                     //$noOfCycles = $this->showCyclePoints($theChild);
                     $fullySponsored = $this->sponsoringDetails($theChild,$theDate,2);//check if parent has a sponsored on left and right
                     if($fullySponsored==1){
                        $this->awardCycleEarnings($theChild,$theDate/*,$db,$transaction*/);
                     }
                }
                
                 $level = $this->getMemberPartsUsingPeopleId($theparent, 4);
                 $theChild = $theparent;
                 $theparent=$this->getMemberPartsUsingPeopleId($theparent, 2);
                 $theStatus=  2;//$this->getMembershipHistory($theChild,$theDate,2);
                 

            }//End While
            //$transaction->commit();
       } catch (\yii\db\Exception $ex){
           throw $ex;
           //$transaction->rollBack();
       }
   }
   
   /**
    * checks to see if amy cycle points have been given
    * @param type $memberId
    * @param type $trxType
    * @param type $theDate
    * @return boolean
    */
   public function checkCyclePoints($memberId,$trxType/*register=1; update=3*/,$theDate)
   {
       
       if(empty(
            (new \yii\db\Query())
                ->select('*')
                ->from('tblcycles')
                ->where([
                    'memberFrom'=>$memberId,
                    'earnDate'=>$theDate,
                    'member'=>$this->getMemberPartsUsingPeopleId($memberId,2),//Parent
                ])->one()                                                                      
               ) ){
           return false;
       } else{
           return true;
       }      
   }
   
   public function getInpaymentItems($memberid,$payFor/* from pointtrxtypes*/,$optn=1){
        $myqry = (new \yii\db\Query())
               ->select('*')
               ->from('inpayments')
               ->where([ 
                   'member'=>$memberid,
                   'ptype'=> $payFor,
                   'confirmed'=>1,
                   ])
               ->one();
        if(!empty($myqry)){
            switch ($optn){
                case 1://package
                   return $myqry['package'];
                case 2://amount
                   return $myqry['amount']; 
                case 3://payment Method
                   return $myqry['pMethod'];    
                case 4://payment date
                   return $myqry['pdate'];
                case 5://payment for
                   return $myqry['ptype'];
            }
        }else{//no entry found
            return -1;
        }
       return;
   }
   /**
    * Checks if there is NO entry in Inpayments table  returns -1 
    *        Else return values stored depending on $optn
    * @param type $member: people.id OR sponsorship.member
    * @param type $payFor: gets value from pointsTrxTypes
    * @param type $optn
    * @return type
    */
   public function isInpaymentsFilled($member,$payFor,$optn=1)
   {
       $myqry = (new \yii\db\Query())
               ->select('*')
               ->from('inpayments')
               ->where([ 
                   'member'=>$member,
                   'ptype'=> $payFor,
                   //'confirmed'=>1,
                   ])
               ->one();
       if(!empty($myqry)){
            switch ($optn){
                case 1://package
                   return $myqry['package'];
                case 2://amount
                   return $myqry['amount']; 
                case 3://payment Method
                   return $myqry['pMethod'];
                case 4://TransactionNo
                   return $myqry['transactionNo'];
                case 5://confirmed
                   return $myqry['confirmed'];

            }
       }else{
           return -1;
       }
   }
   public function showReferralPoints($memberid,$relLevel,$optn=1){
        $myqry = (new \yii\db\Query())
               ->select('Sum(points) as TotalPoints')
               ->from('tblpoints')
               ->where([ 
                   'sponsor'=>$memberid,
                   //
                   ]);
        switch($optn){
             case 1://pending
                 $myqry=$myqry->andWhere(['cashinDate'=>null,])->one();
                 return empty($myqry['TotalPoints'])?0:$myqry['TotalPoints'];
             case 2://paid
                 $myqry=$myqry->andWhere('NOT IsNull(cashinDate)')->one();
                 return empty($myqry['TotalPoints'])?0:$myqry['TotalPoints']; 
             case 3:// all earnings
                 return $myqry->one();
                 return empty($myqry['TotalPoints'])?0:$myqry['TotalPoints'];
             case 4://pending level1
                 $myqry=$myqry->andWhere(['cashinDate'=>null,'relLevel'=>$relLevel,])->one();
                 return empty($myqry['TotalPoints'])?0:$myqry['TotalPoints'];
        }
   }
    public function showCyclePoints($memberid,$optn=1){
        $myqry = (new \yii\db\Query())
               ->select('Sum(lft) as lftPoints, Sum(rgt) AS rgtPoints')
               ->from('tblcycles')
               ->where([ 
                   'member'=>$memberid,
                   
                   ]);
        switch($optn){
            case 1://pending cycles
                 $myqry=$myqry->andWhere(['trxDate'=>null,'cyclesValid'=>1])->one();
                return (int)(Yii::$app->useful->min($myqry['lftPoints'],$myqry['rgtPoints'])/10);
            case 2://paid cycles
                $myqry=$myqry->andWhere('NOT IsNull(trxDate)')->one();
                return (int)(Yii::$app->useful->min($myqry['lftPoints'],$myqry['rgtPoints'])/10);
            case 3://left Pending
                $myqry= $myqry->andWhere(['trxDate'=>null,'cyclesValid'=>1])->one();
                return $myqry['lftPoints'];
            case 4://rgt Pending
                $myqry= $myqry->andWhere(['trxDate'=>null,'cyclesValid'=>1])->one();
                return $myqry['rgtPoints'];
            case 5://Lost cycles
                 $myqry=$myqry->andWhere(['trxDate'=>null,'cyclesValid'=>-1])->one();
                return (int)(Yii::$app->useful->min($myqry['lftPoints'],$myqry['rgtPoints'])/10);
        }
    }               
    
    public function showCyclePointsBal($memberid,$optn=3){
        $myqry = (new \yii\db\Query())
               ->select('*')
               ->from('tblcyclesbal')
               ->where([ 
                   'member'=>$memberid,
                   
                   ]);
        switch($optn){
            
            case 3://left Pending Points
                $myqry= $myqry->one();
                return $myqry['lft'];
            case 4://rgt Pending Points
                $myqry= $myqry->one();
                return $myqry['rgt'];
            default:
                return 0;
        }
    }
    
    public function sponsoringDetails($memberid,$theDate,$optn=1)
    {
        $myqry = (new \yii\db\Query())
               
               ->from('sponsorship')
               ->where([ 
                   'sponsor'=>$memberid,   
                   ])
                ->andwhere('DATEDIFF(:theDate, RecordDate)>=0',[':theDate'=>$theDate]);
        switch($optn){
            case 1://count of sponsored
                $cnt= $myqry->select('count(*) as totalCnt')->one();
                return $cnt['totalCnt'];
            case 2://confirm at least sponsored on left and right then allow cycles count
                $myqry1 = $myqry->select('count(*) as lftCnt')->andWhere('position=1')->one();
                $lftCnt = $myqry1['lftCnt'];
                $myqry2 = $myqry->select('count(*) as rgtCnt')->andWhere('position=2')->one();
                $rgtCnt = $myqry2['rgtCnt'];
                return ($lftCnt>0 && $rgtCnt>0 )?1:0;
            case 3://Left count
                $cnt = $myqry->select('count(*) as lftCnt')->andWhere('position=1')->one();
                return empty($cnt['lftCnt'])?0:$cnt['lftCnt'];
            case 4:
                $cnt = $myqry->select('count(*) as rgtCnt')->andWhere('position=2')->one();
                return empty($cnt['rgtCnt'])?0:$cnt['rgtCnt'];
            default:
                return 0;
        }
    }
    
    public function getMembershipHistory($memberid,$theDate,$optn=1)
    {
        $myqry = (new \yii\db\Query())
               ->select('*')
               ->from('membershiphistory')
               ->where([ 
                   'memberid'=>$memberid
                   
                   ]);
        switch($optn){
            case 1://end of Active status
                $myqry=$myqry->andWhere(['dateEnd'=>null])->one();
                return $myqry['statusEndDate'];
            case 2:
                //$myqry=$myqry->andWhere('(dateEnd=null AND dateStart<= :thedate) OR (dateStart<= :thedate and statusEndDate>= :thedate)', [':thedate'=>$theDate])->one();
                $myqry=$myqry->andWhere(['dateEnd'=>null])->one();
                return $myqry['status'];
            case 3:
                //$myqry=$myqry->andWhere('(dateEnd=null AND dateStart<= :thedate) OR (dateStart<= :thedate and statusEndDate>= :thedate)', [':thedate'=>$theDate])->one();
                $myqry=$myqry->andWhere(['dateEnd'=>null])->one();
                return $myqry['rank'];
            case 4:
                //$myqry=$myqry->andWhere('(dateEnd=null AND dateStart<= :thedate) OR (dateStart<= :thedate and statusEndDate>= :thedate)', [':thedate'=>$theDate])->one();
                $myqry=$myqry->andWhere(['dateEnd'=>null])->one();
                return $myqry['packageId'];
            case 5:
                $myqry=$myqry->andWhere(['dateEnd'=>null])->one();
                return $myqry['expiryDate'];
            case 6:
                $myqry=$myqry->andWhere(['dateEnd'=>null])->one();
                return $myqry['recordDate'];
        }
    }
    public function awardCycleEarnings($memberId,$theDate/*,&$db,&$transaction*/)
    {
        $myqry = (new \yii\db\Query())
               ->select('SUM(lft) as lftPoints,SUM(rgt) as rgtPoints')
               ->from('tblcycles')
               ->where([ 
                   'member'=>$memberId,
                   //'trxDate'=> null,
                   'cyclesValid'=>1,//true
                   
                   ])->one();
        //add balance cycles
        $cyclesAwarded = $this->cycleEarningsAwarded($memberId);
        $noOfCycles= ((int)(Yii::$app->useful->min(($myqry['lftPoints']),($myqry['rgtPoints']))/$this->getAppConstant('pointsPerCycle')))-$cyclesAwarded;
        //$balpoints = abs(($myqry['lftPoints'])-($myqry['rgtPoints']));
        //$side = ($myqry['lftPoints'])>($myqry['rgtPoints'])?1:2;//cyce
        //award $ in tblcycleearnings
        if($noOfCycles > 0){
            $this->addCycleEarnings($memberId,$theDate,$noOfCycles/*,$db,$transaction*/);
            //mark cyclepoints as transferred
            $this->markCycleEarningsMoved($memberId,$theDate/*,$db,$transaction*/);
            //add record for balance
            $this->refreshTblCyclesBal();
        }
        
    }
    public function setValidCyclePoints($memberId,$side,$theDate)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            //add  2 to values in lft and rgt >= $lft
             //$db->createCommand('UPDATE tblcycles SET cyclesValid = -1 where member= :memberId AND DATEDIFF(:thedate,recordDate)>7')->bindParam(':memberId', $memberId)->execute();
            if($side==2){
                $db->createCommand()->update('tblcycles',['cyclesValid'=>-1],['member'=>$memberId,'earnDate'=>null,'lft>0','DATEDIFF(:thedate,recordDate)>:validCycleDaysLimit'],[':thedate'=>$theDate,':validCycleDaysLimit'=>$this->getAppConstant('validCyclePointsTimeLimit')])->execute();
            }elseif($side==1){
                $db->createCommand()->update('tblcycles',['cyclesValid'=>-1],['member'=>$memberId,'earnDate'=>null,'rgt>0','DATEDIFF(:thedate,recordDate)>:validCycleDaysLimit'],[':thedate'=>$theDate,':validCycleDaysLimit'=>$this->getAppConstant('validCyclePointsTimeLimit')])->execute();
            }
            $transaction->commit();
        } catch (Exception $ex) {
            $transaction->rollBack();
            
        }
            //$transaction->commit();
    }
    public function addCycleEarnings($member,$theDate,$noOfCycles/*,&$db,&$transaction*/)
    {
        
        $db=Yii::$app->db;
        //$transaction= $db->beginTransaction();
        try {
                
                $amount = $noOfCycles * $this->getAppConstant('amountEarnedPerCycle');
                $db->createCommand()->insert('tblcycleearnings',
                        [
                            'member'=> $member,
                            'earnDate'=>$theDate,
                            'cycles'=>$noOfCycles,
                            'amount'=>$amount,
                            'recordBy' => Yii::$app->user->id,
                            'recordDate' => date('Y-m-d H:i:s'),
                            ])->execute();
                $this->awardMatchingBonus($member, $theDate,$amount, 1/*,$db,$transaction*/);
                $this->awardMatchingBonus($member, $theDate,$amount, 2/*,$db,$transaction*/);
                //$transaction->commit();
        }
        catch (\yii\db\Exception $ex){
            //$transaction->rollback();
            throw $ex;
        }
       
    }
    
    public function markCycleEarningsMoved($member,$theDate/*,&$db,&$transaction*/)
    {
        $db = Yii::$app->db;
        //$transaction = $db->beginTransaction();
        try {
            
                $db->createCommand()->update('tblcycles',
                        [
                            'trxDate'=>$theDate,
                            'trxBy'=>Yii::$app->user->id,
                            ],['member'=>$member,'cyclesValid'=>1])->execute();
            
            //$transaction->commit();
        }catch(\yii\db\Exception $ex){
            //$transaction->rollBack();
           throw $ex->getMessage();
        }
    }
    public function addBalCycles($member,$thedate,$bal,$side/*,&$db,&$transaction*/){
            $myqry = (new yii\db\Query())
                    ->select('*')
                    ->from('tblcycles')
                    ->where(['member'=>$member])
                    ->one();
            $recAvailable=empty($myqry)?true: false;       
             $db = Yii::$app->db;
             //$theparent=$this->getMemberPartsUsingPeopleId($member, 2);
             try{
                 if($recAvailable){
                        $db->createCommand()
                             ->update('tblcyclesbal', [
                           'member' => $member,
                           //'memberFrom' => $member,
                           'lft'=>$side==1? $bal:0,
                           'rgt'=>$side==2? $bal:0,
                           'earnDate' => $thedate,
                           //'comment'=> 'bal',
                       ],['member' => $member])->execute();
                 }else{
                     $db->createCommand()
                             ->insert('tblcyclesbal', [
                           'member' => $member,
                           //'memberFrom' => $member,
                           'lft'=>$side==1? $bal:0,
                           'rgt'=>$side==2? $bal:0,
                           'earnDate' => $thedate,
                           'comment'=> 'bal',
                       ],['member' => $member])->execute();
                 }
             } catch (\yii\db\Exception $ex){
                 //$transaction->rollback();
                 throw $ex;
             }
    }
    
    public function awardMatchingBonus($memberId,$theDate,$amount,$relLevel/*,&$db,&$transaction*/)
    {
        $db= Yii::$app->db;
        
        $bonusAmount=$sponsor=$rank=$status=0;
        switch($relLevel){
            case 1:
                $bonusAmount= $amount*$this->getAppConstant('matchingBonusPercentLevel1')/100;
                $sponsor = $this->getMemberPartsUsingPeopleId($memberId, 3);
                
                break;
            case 2:
                $bonusAmount= $amount*$this->getAppConstant('matchingBonusPercentLevel2')/100;
                //get sponsor of the sponsor
                $sponsor = $this->getMemberPartsUsingPeopleId($this->getMemberPartsUsingPeopleId($memberId, 3), 3);
                
                break;
            default:
                $bonusAmount=0;
        }
        $rank = $this->getMembershipHistory($sponsor,$theDate, 3);
        $status = 2; //$this->getMembershipHistory($sponsor,$theDate, 2);
        try{
            //$db = Yii::$app->db;
            //$transaction = $db->beginTransaction();
            if($status==2 && $bonusAmount>0 ){
                $db->createCommand()->insert('tblmatching', [
                    
                    'member'  =>  $sponsor,
                    'rank'=> $rank,
                    'memberFrom'=> $memberId,
                    'relLevel'=> $relLevel,
                    'amount' => $bonusAmount,
                    'recordDate' => $theDate,
                    'recordBy'=>Yii::$app->user->id,
                ])->execute();
                
            }elseif($status==1){
                $db->createCommand()->insert('tblmatchingmis', [
                    
                    'member'  =>  $sponsor,
                    'rank'=> $rank,
                    'memberFrom'=> $memberId,
                    'relLevel'=> $relLevel,
                    'amount' => $bonusAmount,
                    'comment'=> 'Status Inactive',
                    'recordDate' => $theDate,
                    'recordBy'=>Yii::$app->user->id,
                ])->execute();
                
            }
            $this->markMatchingCalculated($memberId,$theDate);
            //$transaction->commit();
        } catch (\yii\db\Exception $ex){
            
            //$transaction->rollBack();
            throw $ex;
        }
    }
    public function getParent2($sponsor,$trialparent,$pos)
    {
        
        $testParent=$this->confirmSuitableParent($sponsor, $trialparent>0?$trialparent:$sponsor);
        //get child on pos side
        $aChild = $this->getChildParts($testParent, $pos,3);
        $level = $this->getMemberPartsUsingPeopleId($testParent,4);        
        if(empty($aChild) ||$this->getSponsorshipNo()==1){//testParent Has no child on pos side
            return  $testParent;
        }else{
            $lftVal = $this->getChildParts($testParent, $pos,3);
            $rgtVal= $this->getChildParts($testParent, $pos,4);
            //get all children on pos side
            $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('sponsorship')
                ->andWhere('lft>=:lft and rgt<=:rgt',[':lft'=>$lftVal,':rgt'=>$rgtVal])
                    ->andWhere('level>=:level',[':level'=>$level])
                ->orderBy('level ASC, position DESC')->all();
            foreach($myqry as $myparent){
                $childCnt=$this->getChildren($myparent['member']);
                if($childCnt<2){//
                    return $myparent['member'];
                   // break;
                }
            }
        }        
    }/**
     * retorns the no of records in sponsorship Tabble
     */
    public function getSponsorshipNo()
    {
        
        return (new \yii\db\Query())->select('count(*)')->from('sponsorship')->one();
    }
    public function listTeam($memberId)
    {
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('sponsorship s')
                ->leftJoin('people p', 's.member=p.id')
                ->leftJoin('user u', 'u.peopleId=s.member')
                ->leftJoin('membershiphistory m', 'm.memberId=s.member')
                ->leftJoin('packages k','k.id=m.packageId')
                ->where(['parent'=>$memberId,'dateEnd'=>null])
                
                ->all();
        return $myqry;
    }
    public function markCyclesInvalid($memberId,$theDate)
    {
        $db=Yii::$app->db;
        $statusActive = $this->getMembershipHistory($memberId,$theDate ,2)==2?true:false;
        $fullySponsored = $this->sponsoringDetails($memberId,$theDate,2);//check if parent has a sponsored on left and right
        if($fullySponsored && $statusActive ){
            //Get date by which cycles are valid
            $aDate = Yii::$app->useful->addDateInterval($theDate,$this->getAppConstant('validCyclePointsTimeLimit'));
            $db->createCommand()->update('tblcycles', [
                    'cyclesValid'=> -1,
                    
                ],
                    [
                        'member'=>$memberId,
                        'earnDate<:aDate',
                        'trxDate'=>null,
                        ],
                    [':aDate'=>$aDate])
                    ->execute();
            //update tblcyclesbal
            $db->createCommand()->update('tblcyclesbal', [
                    'cyclesValid'=> -1,
                    
                ],
                    [
                        'member'=>$memberId,
                        'earnDate<:aDate',
                        //'trxDate'=>null,
                        ],
                    [':aDate'=>$aDate])
                    ->execute();
        }        
    }
    public function setPrefPosition($memberId, $side=0/* 0-Auto; 1=Left; 2=Right*/)
    {
         Yii::$app->db->createCommand()
                ->update('sponsorship', ['prefPosition'=>$side], ['$member'=>$memberId])->execute();
    }
    public function getPrefPosition($memberNo)
    {
        $myqry= (new yii\db\Query())
                ->select('*')
                ->from('sponsorship')
                ->where(['membershipNo'=>$memberNo])
                ->one();
        return $myqry['prefPosition'];
    }
    public function extremeSide($memberId,$side)
    {
        $mychild = (new \yii\db\Query())->select('*')->from('sponsorship ')
                ->where( ['position' => $side,'parent'=>$memberId])->one();
        if(empty($mychild)){
            return $memberId;
        } else{ 
            return $this->extremeSide($mychild['member'],$side);
            
        }
    }
    
    public function getTreeDetails($memberId){
        
        $lftVal = $this->getMemberPartsUsingPeopleId($memberId, 8);
        $rgtVal = $this->getMemberPartsUsingPeopleId($memberId, 7);
        $lvl=  $this->getMemberPartsUsingPeopleId($memberId, 4);
		$allowedLvls = $this->getAppConstant('maxLevels');
       return $myqry = (new \yii\db\Query())->select('*')->from('sponsorship s')
                ->leftJoin('people p','s.member=p.id')
                ->where('lft>=:lft', [':lft' => $lftVal])
                ->andWhere('rgt<=:rgt', [':rgt' => $rgtVal])
                ->andWhere('level -:lvl < :allowedLvls',[':allowedLvls'=>$allowedLvls,':lvl'=>$lvl])
                ->orderBy('lft' )
                ->all();
        
    }
    public function getTreeArray($memberId,$detailArr,&$cntrlArr){
        $arr=array();
        
        foreach($detailArr as $theArr){
            
            if($theArr['member']==$memberId){
                $cntrlArr[$theArr['member']]=Null;
            }else{
                $cntrlArr[$theArr['member']]=$theArr['parent'];
                
            }
            $arr[$theArr['member']]['parent']=$theArr['parent'];
            $arr[$theArr['member']]['member']=$theArr['member'];
            $arr[$theArr['member']]['sponsor']=$theArr['sponsor'];
            $arr[$theArr['member']]['firstName'] = $theArr['firstName'];
            $arr[$theArr['member']]['surname'] = $theArr['surname'];
            $arr[$theArr['member']]['memNo'] = $theArr['membershipNo'];
            $arr[$theArr['member']]['status'] = $theArr['status'];
            $arr[$theArr['member']]['position'] = $theArr['position'];
            $arr[$theArr['member']]['level'] = $theArr['level'];
            //get sponsor MembershipNo
            $arr[$theArr['member']]['sponsor'] = $this->getMemberPartsUsingPeopleId($theArr['sponsor']);
            
        }
        return $arr;
    } 
    /**
     * 
     * @param type $tree
     * @param type $root
     * @return type array
     */
    public function parseTree(&$tree, $root = null) {
        $return = array();
        # Traverse the tree and search for direct children of the root
        foreach($tree as $child => $parent) {
            # A direct child is found
            if($parent == $root) {
                # Remove item from tree (we don't need to traverse this again)
                unset($tree[$child]);
                # Append the child into result array and parse its children
                $return[] = array(
                    'name' => $child,
                    'children' => $this->parseTree($tree, $child)
                );
                
            }
        }
        return empty($return) ? null : $return;    
    }
    
    public function prepareTree($tree,&$thetree) {
        
        if(!is_null($tree) /*&& count($tree) > 0*/) {
            $thetree.='<ul>';
            foreach($tree as  $node) {
                $thetree.= '<li>'.$node['name'];
                $this->prepareTree($node['children'],$thetree);
                $thetree.= '</li>';
            }
            $thetree.= '</ul>';
        }
        //return $thetree;
    }
    
    public function prepTree($memberId,$tree,$treeDetail,&$thetree,$curMem) {
        
        if(!is_null($tree) /*&& count($tree) > 0*/) {
            $thetree.='<ul>';
            foreach($tree as $i=> $node) {
                $thetree.= '<li>'.$this->addTreeValue($memberId,$treeDetail[$i],$curMem);
                $this->prepTree($memberId,$node,$treeDetail,$thetree,$curMem);
                $thetree.= '</li>';
            }
            $thetree.= '</ul>';
        }
        //return $thetree;
    }
    public function to_tree($array)
    {
        $flat = array();
        $tree = array();

        foreach ($array as $child => $parent) {
            if (!isset($flat[$child])) {
                $flat[$child] = array();
            }
            if (!empty($parent)) {
                $flat[$parent][$child] =& $flat[$child];
            } else {
                $tree[$child] =& $flat[$child];
            }
        }
            return $tree;
    }
    
    public function parseAndPrepareTree($root, &$tree, &$detailtree,&$result ) {
        //$return = array();
        if(!is_null($tree) && count($tree) > 0) {
            
             $result.='<ul>';
            foreach($tree as $child => $parent) {
                if($parent == $root) {                    
                    unset($tree[$child]);
                    //addTreeVals(&$treeVal,&$memberVals,$memberId)
                    
                    $result.= '<li>'.$this->addTreeVals($result,$detailtree[$child],$parent);
                    //$mytreeout.= '<li>'.$child;
                    unset($detailtree[$child]);
                    $this->parseAndPrepareTree($child, $tree, $detailtree,$result);
                    $result.= '</li>';
                }
            }
            $result.= '</ul>';
        }
        //return $mytreeout;
    }
    public function addTreeVals(&$treeVal,$memberVals,$memberId) {
        $pstn = $memberVals['position']==1?"Left":"Right";
        $memNo = $this->getMemberPartsUsingPeopleId($memberId);
       
        $treeVal .= "<span class='tf-nc treenode'>";
        //$treeVal .= "<a href='". htmlspecialchars( Url::toRoute('/site/join',['parent'=>$memberVals['membershipNo'],'sponsor'=>$this->getMemberPartsUsingPeopleId($memberId),'lft'=>1]))."'>";
        //$treeVal .= $memberVals['status']==2? "<a href='".Url::to(['/dashboard/membership/genealogy','member'=>$memberVals['memNo'],'https'])."'><img src='images/Person14.jpg'":"<img src='images/Person5.jpg'";
        $treeVal .= $memberVals['sponsor']==$memberId? "<a href='".Url::to(['/dashboard/membership/genealogy','member'=>$memberVals['memNo']],'https')."'><img src='images/Person14.jpg'":"<img src='images/Person16.jpg'";
        $treeVal .= " alt = '".$memberVals["surname"]." logo' width ='32px'  height ='32px'"
                ."  title='".
                //$memberVals['firstName']." ".$memberVals['surname']. "'><br>".$memberVals['membershipNo']."<br>Children: ".$this->getParentParticulars($memberVals['member'])."<br>side: ".$this->getMemberPartsUsingPeopleId($memberVals['member'],9)."</span>\n";
                $memberVals['firstName']." ".$memberVals['surname']. "'></a><br>".Html::button(Html::decode($memberVals['memNo']),['class'=>'btn btn-outline-success btn-xs','id'=>'lnk'.$memberVals['memNo'],'value'=>Url::to(['/dashboard/membership/placement','sponsor'=>$memNo,'parent'=>$memberVals['memNo'],'lft'=>1],'https' )])."<br>".$pstn."</span>";
        //$treeVal .=array_pop($stack);
    }
    public function addTreeValue($memberId,$memberVals,$curMem) {
        $treeVal='';
        //$pstn = $memberVals['position']==1?"Left":"Right";
        $sponsorNo = $this->getMemberPartsUsingPeopleId($curMem);
       
        $treeVal .= "<span class='tf-nc treenode'>";
        //$treeVal .= "<a href='". htmlspecialchars( Url::toRoute('/site/join',['parent'=>$memberVals['membershipNo'],'sponsor'=>$this->getMemberPartsUsingPeopleId($memberId),'lft'=>1]))."'>";
//        $treeVal .= $memberVals['status']==2? "<a href='".Url::to(['/dashboard/membership/genealogy','member'=>$sponsorNo])."'><img src='".Url::to(['/images/Person14.jpg'],true)."'":"<img src='".Url::to(['/images/Person5.jpg'],true)."'";
        //$treeVal .= $memberVals['status']==2? "<a href='".Url::to(['/dashboard/membership/genealogy','member'=>$sponsorNo])."'><img src='images/Person14.jpg'":"<img src='images/Person5.jpg'";
        //$treeVal .= $memberVals['status']==2? "<a href='".Url::to(['/dashboard/membership/genealogy','memberId'=>$memberVals["member"]])."'><img src='images/Person14.jpg'":"<img src='images/Person5.jpg'";
        $treeVal .= $memberVals['sponsor']!==$sponsorNo? "<a href='".Url::to(['/dashboard/membership/genealogy','memberId'=>$memberVals["member"]])."'><img src='images/Person14.jpg'":"<a href='".Url::to(['/dashboard/membership/genealogy','memberId'=>$memberVals["member"]])."'><img src='images/Person17.jpg'";
        $treeVal .= " alt = '".$memberVals["surname"]." logo' width ='48px'  height ='48px'"
                ."  title='".
                //$memberVals['firstName']." ".$memberVals['surname']. "'><br>".$memberVals['membershipNo']."<br>Children: ".$this->getParentParticulars($memberVals['member'])."<br>side: ".$this->getMemberPartsUsingPeopleId($memberVals['member'],9)."</span>\n";
                $memberVals['firstName']." ".$memberVals['surname']. "'></a><br>".Html::button(Html::decode($memberVals['memNo']),['class'=>'btn btn-outline-success btn-xs','id'=>'lnk'.$memberVals['memNo'],'value'=>Url::to(['/dashboard/membership/placement','sponsor'=>$sponsorNo,'parent'=>$memberVals['memNo'],'lft'=>1]) ])."<br>".$memberVals['position']."</span>";
        //$treeVal .=array_pop($stack);
        return $treeVal;
    }
    public function showTree($aTree, $root)
    {
        $retVal='<ul> <li>'.$root;
        foreach($aTree as $i=>$item){
            if($i==0){
                $retVal.='<ul><li>'.$item['name'];
            }else{
                $retVal.='</li><li>'.$item['name'];
            }
        }
        $retVal.='</li>';
    }
    
    public function getAppConstant($varName)
    {
        $myqry = (new \yii\db\Query())
               ->select('*')
               ->from('appconstants')
               ->where([ 'constantName'=>$varName])
                ->one();
        return $myqry['constantValue'];
    }
    
    public function getValidGcodesEmail()
    {
        $userDetails = Yii::$app->userdetails;
        
        $myqry = Yii::$app->db->createCommand('SELECT * FROM inpayments i LEFT JOIN user u ON i.member = u.peopleId WHERE i.confirmed IS NULL')
                
                ->queryAll();
               
        $memArr = ArrayHelper::getColumn($myqry,'email');
        
        return $memArr;
    }
    
    public function getMemberPartsByEmail($email,$optn=1)
    {
        $myqry = (new \yii\db\Query())
               ->select('*')
               ->from('inpayments i')
               ->leftJoin('user u','i.member= u.peopleId')
               ->where(['email'=>$email])
               ->one();
        switch($optn){
            case 1:
                return $myqry['member'];
            default:
                return 0;
        }
    }
    public function addWalletEntry($member,$tbl,$trxDate, $trxMethod,$trxId ,$trxDir,$amt)
    {
        $db = Yii::$app->db;
        $db->createCommand()->insert('wallet',[
            'member'=> $member,
            'fromTable'=> $tbl,
            'trxDate' => $trxDate,
            'trxMethod' => $trxMethod,
            'trxId' => $trxId,
            'trxDir' => $trxDir,
            'amount' => $amt,
            'recordBy' => Yii::$app->user->id,
            'recordDate' => date('Y-m-d H:i:s'),
        ])->execute();
    }
    /**
     * @
     * @param type $member
     * @param type $tbl
     * @param type $trxDate
     * @param type $trxMethod
     * @param type $trxId
     * @param type $trxDir
     * @param type $amt
     * 
     */
    public function addCommissionEntry($member,$tbl,$trxDate, $trxMethod,$trxId ,$trxDir,$amt)
    {
        $db = Yii::$app->db;
        $db->createCommand()->insert('commissions',[
            'member'=> $member,
            'fromTable'=> $tbl,
            'trxDate' => $trxDate,
            'trxMethod' => $trxMethod,
            'trxId' => $trxId,
            'trxDir' => $trxDir,
            'amount' => $amt,
            'recordBy' => Yii::$app->user->id,
            'recordDate' => date('Y-m-d H:i:s'),
        ])->execute();
    }
    
    public function displayTree($memberId)
    {
        /*
         *echo OrgChart::widget([
                'data' => [
                        [['v' => 'Mike', 'f' => '<img src="https://placeholdit.imgix.net/~text?txtsize=20&txt=Mike&w=120&h=150" /><br  /> <strong>Mike</strong><br  />The President'],'', 'The President'],
                        [['v' => 'Jim', 'f' => '<img src="https://placeholdit.imgix.net/~text?txtsize=20&txt=Jim&w=120&h=150" /><br  /><strong>Jim</strong><br  />The Test'],'Mike', 'VP'],
                        [['v' => 'ทดสอบ', 'f' => '<img src="https://placeholdit.imgix.net/~text?txtsize=20&txt=ทดสอบ&w=120&h=150" /><br  /><strong>ทดสอบ</strong><br  />The Test'], 'Mike', ''],
                        [['v' => 'Bob', 'f' => '<img src="https://placeholdit.imgix.net/~text?txtsize=20&txt=Bob&w=120&h=150" /><br  /><strong>Bob</strong><br  />The Test'], 'Jim', 'Bob Sponge'],
                        [['v' => 'Caral', 'f' => '<img src="https://placeholdit.imgix.net/~text?txtsize=20&txt=Caral&w=120&h=150" /><br  /><strong>Caral</strong><br  />The Test'], 'Mike', 'Caral Title'],

                ]
            ]); 
         */
        
        $retArr =array();
        $memNo = $this->getMemberPartsUsingPeopleId($memberId);
        $lftVal = $this->getMemberPartsUsingPeopleId($memberId, 8);
        $rgtVal = $this->getMemberPartsUsingPeopleId($memberId, 7);
        $memLvl = $this->getMemberPartsUsingPeopleId($memberId, 4);
        $myqry = (new \yii\db\Query())->select('*')->from('sponsorship s')
                ->leftJoin('people p','p.id=s.member')
                ->leftJoin('membershiphistory h', 's.member= h.memberId')
                ->where('lft>=:lft', [':lft' => $lftVal])
                ->andWhere('rgt<=:rgt', [':rgt' => $rgtVal])
                ->andWhere(['dateEnd'=>null])
                ->orderBy('level', 'position DESC')
                ->all();
        foreach($myqry as $i=> $member)
        {
            $relLvl = $member['level']-$memLvl;
            if( $relLvl >$this->getAppConstant('maxLevels')){
                continue;
            }elseif($i==0){
                $retArr[]=array(array('v'=>$member['member'],'f'=>'<img src="'. Url::to(['/images/Person14.jpg'],true).'" width="50px" /><br/><strong>'.Html::button(Html::decode($member['membershipNo']),['class'=>'btn btn-outline-success btn-xs','id'=>'"lnk'.$member['membershipNo'].'"','value'=>'"'.Url::to(['/dashboard/membership/placement','sponsor'=>$memNo,'parent'=>$member['membershipNo'],'lft'=>1]).'"' ]).'</strong><br/>'),'',$member['firstName'].' '.$member['surname']);
                
            }else{
                $retArr[]=array(array('v'=>$member['member'],'f'=>'<img src="'. Url::to(['/images/Person14.jpg'],true).'" width="50px" /><br/><strong>'.Html::button(Html::decode($member['membershipNo']),['class'=>'btn btn-outline-success btn-xs','id'=>'"lnk'.$member['membershipNo'].'"','value'=>'"'.Url::to(['/dashboard/membership/placement','sponsor'=>$memNo,'parent'=>$member['membershipNo'],'lft'=>1]).'"' ]).'</strong><br/>'),$member['parent'],$member['firstName'].' '.$member['surname']);
            }
        }
        return $retArr;
    }
    function addAuthAssigment($role,$userId){
        $db=Yii::$app->db;
        $db->createCommand()->insert('auth_assignment',
                [
                    'item_name'=>$role,
                    'user_id'=>$userId,
                    'created_at'=> time(),
                    ])->execute();
    }
    
    public function markMatchingCalculated($member,$theDate)
    {
        $db  = Yii::$app->db;
        $db->createCommand()->update('tblcycleearnings',[
            'calcMatchBonus'=> $theDate
        ],[
            'member'=> $member,
            'earnDate'=> $theDate,
        ])->execute();
    }
    public function displayMatchingBonus($memberId, $theDate,$optn=1)
    {
        $myqry = (new \yii\db\Query())
                /*->select ("SUM(amount)  As TotalAmt, 
                            SUM(IF( DATE(recordDate) = DATE(NOW()) , amount , 0 ))  AS AmtToday,
                            SUM(IF( DATE(recordDate) = DATE(ADDDATE(NOW(),-1)) , amount , 0 ))  AS AmtYesterday,
                            SUM(IF( WEEK(recordDate) = WEEK(NOW()) , amount , 0 ))  AS AmtThisWeek,
                            SUM(IF( WEEK(recordDate) = WEEK(NOW())-1 , amount , 0 ))  AS AmtLastWeek,
                            SUM(IF( CONCAT(YEAR(recordDate),MONTH(recordDate)) = CONCAT(YEAR(NOW()),MONTH(NOW())) , amount , 0 ))  AS AmtThisMonth,
                            SUM(IF( CONCAT(YEAR(recordDate),MONTH(recordDate)) = CONCAT(YEAR(NOW()),MONTH(NOW()))-1 , amount , 0 ))  AS AmtLastMonth,
                            SUM(IF( ISNULL(`trxToWalletDate`) , amount , 0 ))  AS PendingToWallet,
                            SUM(IF( NOT ISNULL(`trxToWalletDate`) , amount , 0 ))  AS SentToWallet")*/
                ->from('tblmatching')
                ->where([
                    'member'=> $memberId,
                   
                ]);
        
        switch($optn){
            case 1://All
                $myqry = $myqry->select ("SUM(amount)  As TotalAmt")->one();
                return !empty($myqry['TotalAmt'])?$myqry['TotalAmt']:0;
            case 2://today
                $myqry = $myqry->select ("SUM(amount)  AS AmtToday")
                    ->andWhere('DATEDIFF(recordDate , NOW())=0')
                    ->one();
                return !empty($myqry['AmtToday'])?$myqry['AmtToday']:0;
            case 3://yesterday
                $myqry = $myqry->select ("SUM(amount)  AS AmtYesterday")
                     ->andWhere('DATE(recordDate) = DATE(ADDDATE(NOW(),-1))')
                    ->one();      
                return !empty($myqry['AmtYesterday'])?$myqry['AmtYesterday']:0;
            case 4://this week week starts on monday
                $myqry = $myqry->select ("SUM(amount)  AS AmtThisWeek")
                     ->andWhere('WEEK(recordDate) = WEEK(NOW())')
                    ->one();
               return !empty($myqry['AmtThisWeek'])?$myqry['AmtThisWeek']:0;
            case 5://last Week
                $myqry = $myqry->select ("SUM(amount)  AS AmtLastWeek")
                     ->andWhere('WEEK(recordDate) = WEEK(NOW())')
                    ->one();
                return !empty($myqry['AmtLastWeek'])?$myqry['AmtLastWeek']:0;
            case 6://This month
                $myqry = $myqry->select ("SUM(amount)  AS AmtThisMonth")
                     ->andWhere('CONCAT(YEAR(recordDate),MONTH(recordDate)) = CONCAT(YEAR(NOW()),MONTH(NOW()))')
                    ->one();
                return !empty($myqry['AmtThisMonth'])?$myqry['AmtThisMonth']:0;
            case 7://Last Month
                $myqry = $myqry->select ("SUM(amount)  AS AmtLastMonth")
                     ->andWhere('CONCAT(YEAR(recordDate),MONTH(recordDate)) = CONCAT(YEAR(NOW()),MONTH(NOW()))-1')
                    ->one();
                return !empty($myqry['AmtLastMonth'])?$myqry['AmtLastMonth']:0;
            case 8://Pending to wallet
                $myqry = $myqry->select ("SUM(amount)  AS PendingToWallet")
                     ->andWhere('ISNULL(`trxToWalletDate`)')
                    ->one();
                return !empty($myqry['PendingToWallet'])?$myqry['PendingToWallet']:0;
            case 9://Sent to wallet
                $myqry = $myqry->select ("SUM(amount)  AS SentToWallet")
                     ->andWhere('NOT ISNULL(`trxToWalletDate`)')
                    ->one();
                return !empty($myqry['SentToWallet'])?$myqry['SentToWallet']:0;
            default:
                return 0;
        }
    }
    public function trxPointsToWallet($memberId){
        //get  amount from tblpoints
        $qry = (new \yii\db\Query());
        $myqry = $qry->select('SUM(points) AS totalAmt')
                ->from('tblpoints')
                ->where(['sponsor'=>$memberId])
                ->andWhere(['CashIndate'=>null])
                ->one();
        //update wallet
        $trxId = 'SW'.time();
        $trxDate = date('Y-m-d H:i:s');
        $db = Yii::$app->db;
        $transaction =$db->beginTransaction();
        try{
            $db->createCommand()
                ->insert('wallet',[
                    'member'=>$memberId,
                    'fromTable'=>'Sponsorship',
                    'trxDate'=>$trxDate,
                    'trxMethod'=>7,
                    'trxId'=>$trxId,
                    'trxDir' => 1,
                    'amount' =>!empty($myqry['totalAmt'])?$myqry['totalAmt']:0,
                    'recordBy'=>Yii::$app->user->id,
                    'recordDate'=>date('Y-m-d H:i:s'),
                        
                ])->execute();
        //mark tbl points as transferred
            $db->createCommand()->update('tblpoints',[
                'cashInDate'=>$trxDate,
                'cashInBy'=>Yii::$app->user->id,
            ],[
                'sponsor'=>$memberId,
                'cashInDate'=>null,
            ])->execute();
            $transaction->commit();
        }catch(\yii\db\Exception $ex){
            $transaction->rollBack();
        }
    }
    public function trxCycleEarningsToWallet($memberId){
        //get  amount from tblpoints
        $qry = (new \yii\db\Query());
        $myqry = $qry->select('SUM(amount) AS totalAmt')
                ->from('tblcycleearnings')
                ->where(['member'=>$memberId])
                ->andWhere(['trxToWalletDate'=>null])
                ->one();
        //update wallet
        $trxId = 'CW'.time();
        $trxDate = date('Y-m-d H:i:s');
        $db = Yii::$app->db;
        $transaction =$db->beginTransaction();
        try{
            $db->createCommand()
                ->insert('wallet',[
                    'member'=>$memberId,
                    'fromTable'=>'BinaryCycles',
                    'trxDate'=>$trxDate,
                    'trxMethod'=>7,
                    'trxId'=>$trxId,
                    'trxDir' => 1,
                    'amount' =>!empty($myqry['totalAmt'])?$myqry['totalAmt']:0,
                    'recordBy'=>Yii::$app->user->id,
                    'recordDate'=>date('Y-m-d H:i:s'),
                ])->execute();
        //mark tbl points as transferred
            $db->createCommand()->update('tblcycleearnings',[
                'trxToWalletDate'=>$trxDate,
                'trxToWalletBy'=>Yii::$app->user->id,
            ],[
                'member'=>$memberId,
                'trxToWalletDate'=>null,
            ])->execute();
            $transaction->commit();
        }catch(\yii\db\Exception $ex){
            $transaction->rollBack();
        }
    }
    public function trxMatchingToWallet($memberId){
        //get  amount from tblpoints
        $qry = (new \yii\db\Query());
        $myqry = $qry->select('SUM(amount) AS totalAmt')
                ->from('tblmatching')
                ->where(['member'=>$memberId])
                ->andWhere(['trxToWalletDate'=>null])
                ->one();
        //update wallet
        $trxId = 'CW'.time();
        $trxDate = date('Y-m-d H:i:s');
        $db = Yii::$app->db;
        $transaction =$db->beginTransaction();
        try{
            $db->createCommand()
                ->insert('wallet',[
                    'member'=>$memberId,
                    'fromTable'=>'Matching',
                    'trxDate'=>$trxDate,
                    'trxMethod'=>7,
                    'trxId'=>$trxId,
                    'trxDir' => 1,
                    'amount' =>!empty($myqry['totalAmt'])?$myqry['totalAmt']:0,
                    'recordBy'=>Yii::$app->user->id,
                    'recordDate'=>date('Y-m-d H:i:s'),
                ])->execute();
        //mark tbl points as transferred
            $db->createCommand()->update('tblmatching',[
                'trxToWalletDate'=>$trxDate,
                'trxToWalletBy'=>Yii::$app->user->id,
            ],[
                'member'=>$memberId,
                'trxToWalletDate'=>null,
            ])->execute();
            $transaction->commit();
        }catch(\yii\db\Exception $ex){
            $transaction->rollBack();
        }
    }
    
	public function getReferralBonusParts($memberId,$optn=1)
	{
		$qry = (new \yii\db\Query());
        $myqry = $qry->select('SUM(points ) AS totalAmt')
                ->from('tblpoints')
				->where(['sponsor'=>$memberId]);
		switch($optn){
			case 1://pending
				$myqry = $myqry->andWhere(['cashInDate'=>null])->one();
				return !empty($myqry['totalAmt'])?$myqry['totalAmt']:0;
			case 2:
				$myqry = $myqry->andWhere(['cashInDate'=>! null])->one();
				return !empty($myqry['totalAmt'])?$myqry['totalAmt']:0;
			Default:
				return 0;
		}			
	}
	
	public function teamBonusParts($memberId,$optn=1)
	{
		$qry = (new \yii\db\Query());
        $myqry = $qry->select('SUM(amount ) AS totalAmt, sum(cycles) as totalCycles')
                ->from('tblcycleearnings')
				->where(['member'=>$memberId]);
		switch($optn){
			case 1://pending
				$myqry = $myqry->andWhere(['trxToWalletDate'=>null])->one();
				return !empty($myqry['totalAmt'])?$myqry['totalAmt']:0;
			case 2:// paid amount
				$myqry = $myqry->andWhere(['trxToWalletDate'=>! null])->one();
				return !empty($myqry['totalAmt'])?$myqry['totalAmt']:0;
			case 3://pending cycles
				$myqry = $myqry->andWhere(['trxToWalletDate'=>null])->one();
				return !empty($myqry['totalCycles'])?$myqry['totalCycles']:0;
			case 4: // paid cycles
				$myqry = $myqry->andWhere(['trxToWalletDate'=> ! null])->one();
				return !empty($myqry['totalCycles'])?$myqry['totalCycles']:0;
			case 5://total $ Earned
				$myqry = $myqry->one();
				return !empty($myqry['totalAmt'])?$myqry['totalAmt']:0;
			case 6:// total Cycles
				$myqry = $myqry->one();
				return !empty($myqry['totalCycles'])?$myqry['totalCycles']:0;
			Default:
				return 0;
                }
	}
        	
    public function getWalletBal($memberId)
    {
        $qry = (new \yii\db\Query());
        $myqry = $qry->select('SUM(amount * trxDir) AS totalAmt')
                ->from('wallet')
                ->where(['member'=>$memberId])
                ->one();
        return !empty($myqry['totalAmt'])?$myqry['totalAmt']:0;
    }
    public function checkTransferredFunds($memberId,$optn=1)
    {
        $qry = (new \yii\db\Query());
        $myqry = $qry
                ->from('tblfundstransfer')
                ->where(['memberTo'=>$memberId,
                    'dateAccepted'=>null]);
        switch($optn){
            case 1:
                $myqry = $myqry->select('amount')->one();
                return $myqry['amount'];
            case 2:
                $myqry = $myqry->select('*')->one();
                return $myqry['memberFrom'];
            case 3:
                $myqry = $myqry->select('*')->one();
                return $myqry['fundsTrxCode'];
            default:
                return 0;
        }        
    }
    public function updFundsTransfer($trxCode,$fundsRecvCode,$theDate) {
        $db = Yii::$app->db;
        $db->createCommand()->update('tblfundstransfer',[
            'fundsRcvCode'=>$fundsRecvCode,
            'dateAccepted'=>$theDate,
        ],[
            'fundsTrxCode'=>$trxCode,
        ])->execute();
    }
    public function getBalPoints($memberId,$optn=1/*1=amount; 2=whichSide*/)
    {
        $qry = (new \yii\db\Query());
        $myqry = $qry
                ->from('tblcycles')
                ->where(['member'=>$memberId,])
                ->andWhere(['cyclesValid'=>1,'trxDate'=>!null]);
        switch($optn){
            case 1:
                $myqry=$myqry->select('SUM(lft) as lftPoints,SUM(rgt) as rgtPoints')->one();
                return $myqry['lftPoints']>0?$myqry['lftPoints']:$myqry['rgtPoints'];
            case 2://return the side 1=left 2=right 0=auto/norecord
                $myqry=$myqry->select('SUM(lft) as lftPoints,SUM(rgt) as rgtPoints')->one();
                return $myqry['lftPoints']>0?1:$myqry['rgtPoints']>0?2:0;
            default:
                return 0;
        }
                
    }
    public function getGCodeById($gcId,$optn=1){
        $qry = (new \yii\db\Query());
        $myqry = $qry
                ->select('*')
                ->from('tblgcodes')
                ->where(['id'=>$gcId,])
                ->one();
        switch($optn){
            case 1://code
                return $myqry['code'];
            case 2://memberId
                return $myqry['memberGen'];
            case 3://amount
                return $myqry['amount'];
            case 4://date Generated
                return $myqry['dateGen'];
            case 5://Expiry Date
                return $myqry['expiryDate'];
            case 6://Recipoent Emanil
                return $myqry['recipientEmail'];
        }
    }
    public function getGCodeByCode($gcCode,$optn=1){
        $qry = (new \yii\db\Query());
        $myqry = $qry
                ->select('*')
                ->from('tblgcodes')
                ->where(['code'=>$gcCode,])
                ->one();
        if(!empty($myqry)){
            switch($optn){
                case 1://expired?
                    return $myqry['expiryDate']< date('Y-m-d H:i:s')?'Ex':'Ok';
                case 2://memberId
                    return $myqry['memberGen'];
                case 3://amount
                    return $myqry['amount'];
                case 4://date Generated
                    return $myqry['dateGen'];
                case 5://Expiry Date
                    return $myqry['expiryDate'];
                default:
                    return 0;
            }
        }else{
            return -1;//invalid code
        }
    }
    
   Public function updateGCodesByCode($code,$theDate)
    {
        $userDetails = Yii::$app->userdetails;
        $db= Yii::$app->db;
        $db->createCommand()->update('tblgcodes',[
                'retrieveDate'=>$theDate,
            //this id peopleId
                'retrieveBy'=>$userDetails->getPersonId(Yii::$app->user->id),
            ],
            [
                'code'=> $code,
                ]
            )->execute();
        
    }
    /**
     * 
     * @param type $theDate
     */
    public function reverseGCodes($theDate)
    {
        
        $myrecs = (new  yii\db\Query())
                ->select('*')
                ->from('tblgcodes')
                ->where(['retrieveDate'=>null])
                ->andWhere('DATEDIFF(:theDate,expiryDate)>0',[':theDate'=>$theDate])
                ->all();
        foreach($myrecs as $myrec){
            // cancel gcode by placing gcodes
            $gcode = $myrec['code'];
            $this->cancelGCode($gcode, $theDate);
            
            
            //add wallet entry addWalletEntry($member,$tbl,$trxDate, $trxMethod,$trxId ,$trxDir,$amt)
            $amt = $myrec['amount'];
            $trxId = $myrec['code'].'C';
            $member  = $myrec['memberGen'];
            $tbl = 'GCodes';
            $trxDate = $theDate;
            $trxMethod = 12;
            $this->addWalletEntry($member,$tbl,$trxDate, $trxMethod,$trxId ,1 /*return to wallet*/,$amt);            
        }
                
               
        
    }
    /**
     * 
     * @param type $gcode
     * @param type $theDate
     */
    public function cancelGCode($gcode,$theDate)
    {
         Yii::$app->db->createCommand()
                 ->update('tblgcodes',[
                     'retrieveDate'=> $theDate,
                 ],
                   [
                    'code'=>$gcode,

                   ]);
    }
    
    public function doAutoMember($model)
    {
        $userDetails = Yii::$app->userdetails;
        
        //$this = Yii::$app->memberdetails;
        $memberId = $userDetails->getPersonId(Yii::$app->user->id);
        $userId = $userDetails->getUserParts($memberId);
        //get temp sposor Detatils
        $sponsorNo=$this->getTempSponsorDetails($userId);
        // $msg.='<br>sponsorNo: '.$sponsorNo;
        $side = $this->getTempSponsorDetails($userId,2);
        // $msg.='<br>Side: '.$side;
        $memberId = $userDetails->getPersonId($userId);
        //$msg= 'Sponsor found(tempSponsor): '.$sponsor.'<br>';
        $sponsorId = $this->getMemberPartsUsingMemberNo($sponsorNo);
        // $msg.='<br>sponsorId: '.$sponsorId;
        $parentNo=$this->getTempSponsorDetails($userId,3);
        // $msg.='<br>ParentNo: '.$parentNo;
        $parMethod = $this->getTempSponsorDetails($userId,4);
        if($parMethod==1){
        // $msg.='<br>Parenting Method: '.$parMethod;
        $parentId = $this->getTempSponsorDetails2($memberId,3)>0?$this->getMemberPartsUsingMemberNo($this->getTempSponsorDetails2($memberId,3)):$this->getChildParts($sponsorId,($side==1?1:2),2);
        // $msg.='<br>ParentId: '.$parentId;
        $parent = $this->getParent($sponsorId,$parentId,$pos=$side==1?1:2);
         //$parent= $trialParent>0?$trialParent:$sponsorId;
        // $msg.='<br>Trial Parent: '.$parent;
        $position = $this->getNextPosition($parent,$side);
        // $msg.='<br>Position: '.$position;
        }elseif($parMethod=2){
            $parentId = $this->getMemberPartsUsingMemberNo($this->getTempSponsorDetails2($memberId,3));
            // $msg.='<br>ParentId: '.$parentId;
            $parent = !empty($this->extremeSide($parentId,$side))?$this->extremeSide($parentId,$side):$parentId;
             //$parent= $trialParent>0?$trialParent:$sponsorId;
            // $msg.='<br>Trial Parent: '.$parent;
            $position = $side;
            // $msg.='<br>Position: '.$position;
        }elseif($parMethod=3){
            $parentId = $this->getMemberPartsUsingMemberNo($this->getTempSponsorDetails2($memberId,3));
            // $msg.='<br>ParentId: '.$parentId;
            $myparentNo=$this->getTempSponsorDetails($userId,3);
            $myparentId = $this->getMemberPartsUsingMemberNo($myparentNo);
            $parent = $this->extremeSide($myparentId,$side);//!empty($this->extremeSide($parentId,$side))?$this->extremeSide($parentId,$side):$parentId;
             //$parent= $trialParent>0?$trialParent:$sponsorId;
            // $msg.='<br>Trial Parent: '.$parent;
            $position = $side;
            // $msg.='<br>Position: '.$position;
        }

        //try{
        //$db = Yii::$app->db;
        //$transaction=$db->beginTransaction();
        $msg='';
         $msg=$this->addChild($memberId,$parent,$sponsorId,$position);
        //get Status and Rank from Sponsorship table
        $prevrank = 1;//$this->getMemberPartsUsingPeopleId($memberId,11);//rankId
        $prevstatus = 2;// $this->getMemberPartsUsingPeopleId($memberId, 10);
        $this->updMemberHistory($memberId,$model->package,$prevstatus,$prevrank,$model->pdate,1);
        //$this->updMemberHistory($memberId,$model->package);
        //update sponsorhip tablea
        //Assign a Role
        $this->addAuthAssigment($model->package0->packName,Yii::$app->userdetails->getUserparts($memberId));
        $this->addRegistrationPoints($memberId,$model->pdate,1,1);//level1
        $this->addRegistrationPoints($memberId,$model->pdate,1,2);//level2
        //update binary table
        $this->addCyclePoints($memberId,1/*1= registration */,$model->pdate);
        /*$this->awardCycleEarnings($memberId,$model->pdate);
        $this->awardMatchingBonus($memberId,$model->pdate,1);
        $this->awardMatchingBonus($memberId,$model->pdate,2);*/
        $model->sendMemConfirmEmail($memberId);
        sleep(5);
        $model->sendSponsorDlEmail($memberId); 
        $this->refreshTblCyclesBal();
        
    }
    
    public function doAutoSubscribe($model){
                $msg='';
                //$this=Yii::$app->memberdetails;
                //$userDetails = Yii::$app->userdetails;
                $memberId = $model->member;
                $confirmDate = $model->recordDate;
                $prevrank = $this->getMemberPartsUsingPeopleId($memberId,11);//rankId
                $prevstatus = $this->getMemberPartsUsingPeopleId($memberId, 10);
                $this->updMemberHistory($memberId,$model->package,$prevstatus,$prevrank,$confirmDate,2);
                //$this->sendMemSubsEmail($memberId);
                //$this->sendSponsorSubsEmail($memberId);
                return $msg;
    }
    
    public function doAutoUpgrade($model){
                $memberId = $model->member;
                $msg='';
                $Oldrank = $this->getMemberHistory($memberId,3);//rankId
                $Oldstatus = $this->getMemberHistory($memberId,2);
                $this->updMemberHistory($memberId,$model->package,$Oldstatus,$Oldrank,$model->pdate,3);
                /// update Permissions
                $userId = Yii::$app->userdetails->getUserParts($memberId);
                $this->updAuthAssignment($userId,$model->package);
                //update sponsorhip table
                $this->addRegistrationPoints($memberId,$model->pdate,3,1);//level1
                $this->addRegistrationPoints($memberId,$model->pdate,3,2);//level2
                //update binary table
                $this->addCyclePoints($memberId,3/*3= upgrade */,$model->pdate);
                $model->sendMemUpgradeEmail($memberId);
                sleep(5);
                $model->sendSponsorUpgradeEmail($memberId);
                $this->refreshTblCyclesBal();
                return $msg;
    }
    public function confirmPay($memberId,$trxno,$theDate)
    {
        $db=Yii::$app->db;
        $db->createCommand()
                ->update('inpayments',[
                    'confirmed'=>1,
                    'confirmBy'=>1,
                    'confirmDate'=>date('Y-m-d H:i:s'),
                ],[
                    'member'=>$memberId,
                    'pdate'=> $theDate,
                    'transactionNo'=>$trxno,
                ])->execute();
    }
    
    public function fundsTransferAvailable($memberId,$optn=1)
    {
        $myqry= (new yii\db\Query())
                ->select('*')
                ->from('tblfundstransfer')
                ->where([
                    'memberTo'=>$memberId,
                    'dateAccepted'=>null,
                    ])->one();
        switch($optn){
            case 1:
                return $myqry['fundsTrxCode']  ;
            case 2:
                return $myqry['amount'];
            default:
                return 0;
        }
              
        
    }
    
    public function giftCodeValue($giftCode,$optn=1)
    {
        $myqry = (new yii\db\Query())
                ->select('*')
                ->from('tblgcodes')
                ->where([
                    'code'=>$giftCode,
                    
                    ])->one();
        switch($optn){
            case 1:
                return $myqry['amount'];
            default:
                return 0;
        }
    }
    
    public function getPackageFromValue($amt,$trxType,$optn=1)
    {
    
        $myqry = (new yii\db\Query())
                ->select('*')
                ->from('packconfig c')
                ->leftJoin('packages p','p.id=c.packId')
                ->where([
                    'trxType'=>$trxType,
                    'amount'=>$amt,
                    ])->one();
        switch($optn){
            case 1:
                return $myqry['packId'];
            case 2:
                return $myqry['packName'];
            case 3:// action string
                return ($trxType==1)? $myqry['packName'].' Package Registration':($trxType==2?$myqry['packName'].' Package Subscription':($trxType==3?'Upgrade to '.$myqry['packName'].' Package':''));
            default:
                return '';
        }
    }
    public function getPackageFromPrefix($prefix,$optn=1)
    {
    
        $myqry = (new yii\db\Query())
                ->select('*')
                ->from('packconfig c')
                ->leftJoin('packages p','p.id=c.packId')
                ->where([
                    'prefix'=>$prefix,
                    
                    ])->one();
        switch($optn){
            case 1:
                return $myqry['packId'];
            case 2://Package Name
                return $myqry['packName'];
            case 3:// transaction type
                return $myqry['trxType'];
            case 4://registration amount
                return $myqry['Amount'];
            case 5://sponsor points
                return $myqry['sponsorPoints'];
            case 6://cycle points
                return $myqry['cyclePoints'];
        }
    }
    public function getPackConfigOptions($optn=1)
    {
        $myarr = array();
        $myqry = (new yii\db\Query())
                ->select('*')
                ->from('packconfig c')
                ->leftJoin('packages k', 'k.id=c.packId')
                ->leftJoin('paymenttypes p', 'p.id=c.trxType');
                
        switch($optn){
            case 1:
                $myqry = $myqry->all();
                break;
            case 2:
                $myqry = $myqry->where(['p.id'=>[1,3]])->all();//removal of subscrition
        }
        foreach($myqry as $i=>$item){
            if($i==2){
                $myarr[$i]['item']= $item['ptypeName'].' to '.$item['packName'].' ($ '.$item['amount'].')';
            }else{
                $myarr[$i]['item']=$item['packName'].' '.$item['ptypeName'].' ($ '.$item['amount'].')';
            }
            $myarr[$i]['id']=$i+1 ;
        }
        return $myarr;
    }
    
   
    
    public function getPackConfigItemsById($id,$optn=1)
    {
        $myqry = (new yii\db\Query())
                ->select('*')
                ->from('packconfig');
                
        switch($optn){
            case 1://amount
                $myqry = $myqry->where(['id'=>$id])->one();
                return $myqry['amount'];
            case 2://prefix
                $myqry = $myqry->where(['id'=>$id])->one();
                return $myqry['prefix'];
        }
    }
    public function memberHasHistory($memberid)
    {
        $myqry = (new yii\db\Query())
                ->select('*')
                ->from('membershiphistory')
                ->where(['memberId'=>$memberid])
                ->one();
        return empty($myqry)?false:true;

    }
    public function getPackName($id){
        $myqry = (new yii\db\Query())
                ->select('*')
                ->from('packages')
                ->where(['id'=>$id])
                ->one();
        return $myqry['packName'];
    }
    public function getPTypeName($id){
        $myqry = (new yii\db\Query())
                ->select('*')
                ->from('paymenttypes')
                ->where(['id'=>$id])
                ->one();
        return $myqry['ptypeName'];
    }
    public function refreshTblCyclesBal()
    {
        $db=Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand('DROP TABLE tblcyclesbal')->execute();
        $db->createCommand("CREATE TABLE `tblcyclesbal` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `member` int(11) NOT NULL,
                    `lft` double NOT NULL DEFAULT '0' COMMENT 'Amount in PV',
                    `rgt` double NOT NULL DEFAULT '0' COMMENT 'Amount in PV',
                    `earnDate` datetime NOT NULL,
                    `cyclesExpected` int(11) NOT NULL DEFAULT '0',
                    
                    PRIMARY KEY (`id`),
                    KEY `fk_tblcyclesMember_peopleId_idx` (`member`),
                    CONSTRAINT `fk_tblcyclesbalMember_peopleId` FOREIGN KEY (`member`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
                   ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci")
                ->execute();
        $db->createCommand("INSERT INTO tblcyclesbal ( member, lft, rgt, cyclesExpected )"
                . " SELECT member, IF(SUM(lft)>SUM(rgt),ABS(SUM(lft)-SUM(rgt)),0) as lft, IF(SUM(lft)<SUM(rgt),ABS(SUM(lft)-SUM(rgt)),0) as rgt, IF(SUM(lft)<SUM(rgt),SUM(lft),SUM(rgt))/10 AS cyclesExpected FROM tblcycles WHERE cyclesValid=1 GROUP BY member ")->execute();
        $transaction->commit();
   }
   public function cycleEarningsAwarded($memberId){
       $myqry = (new yii\db\Query())
               ->select('SUM(Cycles) AS TotalCycles')
               ->from('tblcycleearnings')
               ->where(['member'=>$memberId])
               ->one();
       return !empty($myqry['TotalCycles'])?$myqry['TotalCycles']:0;
   }
   
   public function updAuthAssignment($userId,$packId)
   {
      
       $db=Yii::$app->db;
       $db->createCommand()
               ->update('auth_assignment',
                       [
                           'item_name'=> $this->getPackName($packId),
                           'created_at'=>time(),
                           ],
                       ['user_id'=>$userId])->execute();
   }
   /**
    * Checks if AuthAssignment Record exists if so updates if not  creates new record
    * @param type $userId
    * @param type $packId
    */
   public function checkAuthAssignment($userId,$packId)
   {
       $db=Yii::$app->db;
       $myqry = (new yii\db\Query())
               ->select('*')
               ->from('auth_assignment')
               ->where(['user_id'=>$userId,
                   
                   ])
               ->one();
       if($myqry['item_name']=='admin'){
           return;
       }
       elseif(!empty($myqry)){
           $this->updAuthAssignment($userId,$packId);
       }else{
           $db->createCommand()
               ->insert('auth_assignment',
                       [
                           'item_name'=> $this->getPackName($packId),
                           'user_id'=> $userId,
                           'created_at'=>time(),
                           ]
                       )->execute();
       }
   }
   
   public function updInpayments($model/*Cptransactions Record*/)
   {
       $db=Yii::$app->db;
       $db->createCommand()
               ->insert('inpayments',[
                    'member'=>$model->memberId,
                    'pMethod'=>4,
                    'package'=>$model->packId,
                    'ptype'=>$model->trxId,
                    'amount'=>$model->amount,
                    'pdate'=>date('Y-m-d H:i:s'),
                    'transactionNo'=> $model->bc_trx_id,
                    'recordBy'=>Yii::$app->user->id,
                    'recordDate'=>date('Y-m-d H:i:s'),
                   ])->execute();
           
   }
}
