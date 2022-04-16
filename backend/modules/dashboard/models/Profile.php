<?php


namespace backend\modules\dashboard\models;

use Yii;
use yii\base\Model;
use\yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Description of Profile
 *
 * @author Apache1
 */
class Profile extends Model {
    public $phone;
    public $placement;
    public $email;
    public $prefix;
    
    public function rules(){
        return [
            [['email'],'email'],
            [['prefix'].'string'],
            [['placement'],'integer','range'=>[0,1,2]],
            [['phone'],'']
        ];
    }
}
