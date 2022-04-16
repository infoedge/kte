<?php
namespace common\components;

use Yii;
use yii\base\Component;

use common\models\Users;

class UserDetails extends Component
{
    public function getPersonId($id){
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('user ')
                ->where(['id'=>$id])
                ->one();
        return $myqry['peopleId'];
    }
    public function getUserParts($id,$optn=1){
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('user ')
                ->where(['peopleId'=>$id])
                ->one();
        switch($optn){
            case 1://user.id
                return $myqry['id'];
            case 2://email
                return $myqry['email'];
            case 3:
                return $myqry['username']; 
             case 4:
                return $myqry['status'];
        }
    }
    
    public function getUserPartsByUsername($usrName,$optn=1){
        $myqry = (new \yii\db\Query())
                ->select('*')
                ->from('user u')
                ->leftJoin('people p','p.id=u.peopleId')
                ->leftJoin('titles t', 't.id = p.titleId')
                ->where(['username'=>$usrName])
                ->one();
        switch($optn){
            case 1://user.id
                return $myqry['peopleId'];
            case 2://email
                return $myqry['email'];
            case 3:
                return $myqry['username']; 
             case 4:
                return $myqry['status'];
            case 5://Users Name
                //$this->msg .= 'firstName: ' . $myqry['firstName'];
                return $myqry['title'] . ' '. $myqry['firstName'] . ' ' . $myqry['surname'];
        }
    }
}