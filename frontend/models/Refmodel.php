<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

class Refmodel extends Model {
    public $sponsor;
    public $parent;
    public $lft;//position
    public $m ;//method
    public $memberId;//
    public $memberName;
    public function init()
    {
        $session=  Yii::$app->session;
        //$request = Yii::$app->request;
        $memberDetails =Yii::$app->memberdetails;
        if($session->isActive  ){
           $this->sponsor = Yii::$app->session['sponsor'];
           $this->parent = !empty(Yii::$app->session['parent'])?Yii::$app->session['parent']:Yii::$app->session['sponsor'];
           $this->lft = !empty(Yii::$app->session['lft'])? Yii::$app->session['lft']: 3 ;
           $this->m = !empty(Yii::$app->session['m'])? Yii::$app->session['m']: 3 ;
           if(!empty($this->sponsor)){
                $this->memberId = $memberDetails->getMemberPartsUsingMemberNo($this->sponsor);
                $this->memberName = $memberDetails->getMemberPartsUsingPeopleId($this->memberId,6);
           }
        }
        
    }
}
