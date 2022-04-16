<?php
namespace backend\modules\dashboard\models;

use Yii;
use yii\base\Model;
use\yii\helpers\ArrayHelper;
use yii\helpers\Html;



/**
 * Description of Geneology
 *
 * @author Apache1
 */
class Geneology extends Model {
    public $treeArr ;
    public $cntrlArr;
    public $aTree ;
    public $parsedArr;
    public $treeList =  '';
}