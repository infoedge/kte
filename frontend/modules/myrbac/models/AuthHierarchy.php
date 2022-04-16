<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\modules\myrbac\models;

use yii\base\Model;

/**
 * Description of AuthHierarchy
 *
 * @author Apache1
 */
class AuthHierarchy extends Model{
    public $parent;
    public $children;
    public function rules()
    {
        return [
            [['parent','child'],'required'],
            [['parent','child'],'string'],
            
        ];
    }
    public function attributeLabels(){
        return [
            'parent' =>'Dependent role or Permission',
            'child' => 'Base Permission or Role',
        ];
    }
}
