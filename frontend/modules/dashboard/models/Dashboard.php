<?php

namespace frontend\modules\dashboard\models;

use Yii;
use yii\base\Model;
use\yii\helpers\ArrayHelper;
use yii\helpers\Html;


/**
 * Description of Membership
 *
 * @author Apache1
 */
class Dashboard extends Model {
    public $position;
    public $lftside;
    public $rgtside;
    public $placement;
    public $pMethodStr;
    public $parMethod;
    public $thelink;
    public function rules()
    {
        return [
            [['placement','parMethod'], 'integer'],
            [['placement','thelink'], 'required'],
            [['position','thelink','lftside','rgtside','pMethodStr'], 'string', 'max' => 200],
        ];
    }
}

