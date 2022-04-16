<?php
namespace backend\modules\dashboard\models;

use Yii;
use yii\base\Model;
/**
 * Description of Placement
 *
 * @author Apache1
 */
class Placement extends Model {
    public $sponsor;
    public $parent;
    public $pos;
    public $homelnk;
    public $thelnk;
    public $methodstr;

    public function rules() {
        return [
            [['sponsor','parent','pos'],'required'],
            [['sponsor','parent','pos','methodstr'],'integer'],
            [['sponsor','parent'],'integer','min'=>1000000,'max'=>9999999,'message'=>'The Member no. entered is invalid'],
            [['homelnk','thelnk'],'string'],
        ];
    }
    public function attributeLabels() {
        return [
            'sponsor' =>Yii::t('app','Sponsor'),
            'parent' =>Yii::t('app','Place Under'),
            'pos' =>Yii::t('app','Placement'),
            'thelnk' =>Yii::t('app','Your Marketing Link')
        ];
    }
}
