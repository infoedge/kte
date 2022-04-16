<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

/**
 * Description of communication
 *
 * @author Apache1
 */

use Yii;
use yii\base\Component;

class Communication extends Component {
    public function removePhoneCountryCode($phoneno,$countryId)
    {
        //get dialcode and exit_code from country codes
        $countryCode = $this->getDialCodeParts($countryId);
        $trunkCode=$this->getDialCodeParts($countryId,3);
        //drop dialcode and add exit_code
        return str_replace('+'.$countryCode, $trunkCode, $phoneno );
    }
    private function getDialCodeParts($countryId,$optn=1)
    {
        $qry = (new \yii\db\Query());
        $myvals=$qry->select('*')
                ->from('dialcodes')
                ->where(['c_id'=>$countryId])
                ->one();
        switch($optn){
            case 1:// countryCode
                return $myvals['countryCode'];
            case 2://exitCode
                return $this->getFirstNumberOnly($myvals['exitCode']);
            case 3://trunkCode
                return $this->getFirstNumberOnly( $myvals['trunkCode']);
        }
    }
    
    private function getFirstNumberOnly($tc)
    {
        $nonNum=true;
        $outStr = '';
        for($i=0;$i<strlen($tc);$i++){
            if(is_numeric(substr($tc,$i,1))&& $nonNum==true){
                $outStr.= substr($tc,$i,1);
            }elseif(!is_numeric(substr($tc,$i,1))&& (strlen($outStr)>0)){
                $nonNum=false;
            }
        }
        return $outStr;
    }
}
