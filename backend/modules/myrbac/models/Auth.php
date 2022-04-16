<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\modules\myrbac\models;

use yii\base\Model;

/**
 * Description of Auth
 *
 * @author Apache1
 */
class Auth extends Model {
    public $permissionOrRole;
    public $description;
    public $titleType;
    //public $mytype; //type of authItem
    public $typeTitle;
    
    public function rules()
    {
      return [
          [['permissionOrRole','description'],'required'],
          //['mytype','integer'],
          [['permissionOrRole'],'string','max' => 30],
          [['description'],'string','max' => 255],
      ];  
    }
}
