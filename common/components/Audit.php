<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

use Yii;
use yii\base\Component;
use backend\modules\payments\models\Inpayments;

/**
 * Description of Remedy
 *
 * @author Apache1
 */
class Audit extends Component {

    public function remSponDuplicates() {
        $qry = "SELECT `sponsor`,memberFrom,relLevel, recordDate, bonusType, count(points) p FROM `tblpoints` 
            GROUP BY `sponsor`, `memberFrom`
            HAVING p>1";
        $myqry = (new \yii\db\Query())
                ->select('sponsor,memberFrom,relLevel, recordDate, bonusType, count(points) p')
                ->from('tblpoints')
                ->groupBy('sponsor', 'memberFrom')
                ->having('p>1')
                ->all();
        foreach ($myqry as $item) {
            $myqry2 = (new \yii\db\Query())
                    ->select('max(id) as theId, sponsor, memberFrom, relLevel, recordDate, bonusType')
                    ->from('tblpoints')
                    ->where([
                        'sponsor' => $item['sponsor'],
                        'memberFrom' => $item['memberFrom'],
                        'relLevel' => $item['relLevel'],
                        'recordDate' => $item['recordDate'],
                        'bonusType' => $item['bonusType'],
                    ])
                    ->one();

            $db = Yii::$app->db;
            $db->createCommand()
                    ->delete('tblpoints', [
                        'id' => $myqry2['theId'],
                    ])->execute();
        }
    }

    /*
     * updates auditCntrl in tblpoints
     */

    public function tblPointsAuditStart() {
        
        //$transaction = $db->beginTransaction();
        $memberDetails = Yii::$app->memberdetails;
        $useful = Yii::$app->useful;
        $myqry = (new yii\db\Query())
                ->select('*')
                ->from('tblpoints')
                //->where(['auditCntrl' => ''])
                ->all();
       // try {
            foreach ($myqry as $rec) {
                $mycntrl = $memberDetails->getMemberPartsUsingPeopleId($rec['memberFrom']) . $memberDetails->getMemberPartsUsingPeopleId($rec['sponsor']) . $useful->x_digit($rec['bonusType'], 3);
                if ($this->confirmUniqueTblpoints($mycntrl)) {
                    $this->updAuditCntrl($rec['id'], $mycntrl);
                } else {//Record already avalable
                    $this->delFake($rec['id']);
                }
            }
           // $transaction->commit();
            return 1;
        /*} catch (yii\db\Exception $ex) {
            $transaction->rollBack();
            return 0;
        }*/
    }

    /**
     * 
     * @param type $cntrlval
     * @return boolean
     */
    protected function confirmUniqueTblpoints($cntrlval) {
        $myqry = (new yii\db\Query())
                ->select('auditCntrl')
                ->from('tblpoints')
                ->where(['auditCntrl' => $cntrlval])
                ->one();
        if (!empty($myqry)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 
     * @param type $id
     * @param type $db
     */
    protected function delFake($id/*, &$db*/) {
        $db = Yii::$app->db;
        $db->createCommand()
                ->delete('tblpoints', 'id=:id', [':id' => $id])
                ->execute();
    }

    protected function updAuditCntrl($id, $cntrlVal/*, &$db*/) {
        $db = Yii::$app->db;
        $db->createCommand()
                ->update('tblpoints', [
                    'auditCntrl' => $cntrlVal,
                        ], [
                    'id' => $id,
                ])->execute();
    }
    
    /**
     * confirms payment only (without registering) 
     * @param type $memberId
     * @param type $theDate
     * @param type $trxId
     */
    public function confirmPaymentOnly($memberId,$theDate, $trxId=1)
    {
        $db = Yii::$app->db;
        $db->createCommand()
                ->update('inpayments', [
                    'confirmed' => 1,
                    'confirmBy'=>Yii::$app->user->id,
                    'confirmDate' => $theDate,
                        ], [
                    'member' => $memberId,
                    'ptype'=> $trxId,
                ])->execute();

    }
    
    public function confirmAllRegistrations()
    {
        $memberDetails= Yii::$app->memberdetails;
        $userDetails = Yii::$app->userdetails;
        
        $msg='';
        //confirm inpayments record
        $models= Inpayments::find()->all();
        
        foreach($models as $model){
            $memberId = $model->member;
            //if(Yii::$app->memberdetails->memberHasHistory(Yii::$app->userdetails->getPersonId(Yii::$app->user->id))){
            //is there a membershiphistory?
            if(empty($memberDetails->getMemberHistory($memberId))){
                //get packId from amount and create member history
                $packId = $memberDetails->getPackageFromValue($model->amount,1/*Registration*/);
                $memberDetails->addMemberHistory($memberId,$packId,2/*active*/, 1/*'$ranknew'*/,$model->pdate,1);
                $msg.='Membership History Added <br>';
            }
            $packId = $memberDetails->getMemberHistory($memberId);
            //confirm AuthAssignment
            $userId = $userDetails->getUserParts($memberId);
            
            $memberDetails->checkAuthAssignment($userId,$packId);
            //confirm RegistrationPoints
            if(!($memberDetails->checkRegistrationPoints($memberId/*id of sponsored members */,$model->pdate,1,1/*level=1*/))){
                $memberDetails->addRegistrationPoints($memberId/*id of sponsored members */,$model->pdate,1,1/*level*/);
                 $msg.='Registration Points Level 1 Added <br>';
            }
            if(!($memberDetails->checkRegistrationPoints($memberId/*id of sponsored members */,$model->pdate,1,2/*level=1*/))){
                $memberDetails->addRegistrationPoints($memberId/*id of sponsored members */,$model->pdate,1,2/*level*/);
                $msg.='Registration Points Level 2 Added <br>';
            }
            //Confirm cyclePoints
            if(!($memberDetails->checkCyclePoints($memberId,1/*register=1; update=3*/,$model->pdate)))
            {
                $memberDetails->addCyclePoints($memberId,1/*register=1; update=3*/,$model->pdate);
                $msg.='Cycle Points Level  Added <br>';
            }
            
        }if($msg=''){//no payment found
            $msg.='No payment information found <br>';
        }
        return $msg;
    }
}
