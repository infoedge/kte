<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$memberDetails=Yii::$app->memberdetails;
$userDetails=Yii::$app->userdetails;
$theDate = date('Y-m-s H:i:s');
$memberNo = $memberDetails->getMemberPartsUsingPeopleId($memberid);
$package = $memberDetails->getPackName($memberDetails->getMembershipHistory($memberid,$theDate,4));
$username = $userDetails->getUserParts($memberid,3);
$memberName = $memberDetails->getMemberPartsUsingPeopleId($memberid,6);
$affiliatelink = str_replace("backend","frontend", \yii\helpers\Url::toRoute(['/site/index','sponsor'=>$memberNo],true));
?>
<div class="memconfirm-email">
    <H3>Hello <?= Html::encode($memberName) ?>,</H3>
    
    <p>Congratulations from Knowledgetoearn.com. </p>
<p>You now have successfully upgraded to <?= $package ?> package.</p>

<p>This now allows you access to more self-development material and better earning potential when you introduce this platform to others.</p>
<p>We at Knowledgetoearn.com, once again, wish you all the best in your business.</p>
<h4>Income Disclaimer.</h4>
<p>Please note that the Knowledgetoearn.com opportunity offers unlimited income potential from application of the knowledge given through the platform and also from the affiliate membership. However, Knowledgetoearn.com does not make any guarantee of success.</p>
   
</div>
