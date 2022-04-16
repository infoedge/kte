<?php

/*
 * Sets default values
 * 
 * 
 */

namespace common\components;

use Yii;
use yii\base\Component;

class PeopleDefaults extends Component{
    public function setValues(&$modelname)
    {
        $modelname->IdentityType=Yii::$app->params['identityTypeId'];
        //$modelname->nationality = Yii::$app->params['countryId'];
    }
}
