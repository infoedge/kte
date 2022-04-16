<?php
namespace backend\modules\dashboard\models;

use Yii;
use yii\base\Model;
use\yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Description of Memberselect
 *
 * @author Apache1
 */
class Memberselect extends Model {
    
    public $member;
    public function rules() {
        return [
            ['member','required'],
            ['member','integer'],
            
        ];
    }
}
