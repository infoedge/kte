<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\modules\payments\models;

use Yii;
use yii\base\Model; 


class ConfirmMemberDetails extends Model {
    public $member;
    public function rules()
    {
     return [
         [['member'],'required'],
     ] ;  
}
            
}
