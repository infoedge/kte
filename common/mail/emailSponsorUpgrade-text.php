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
$sponsorId = $memberDetails->getMemberPartsUsingPeopleId($memberid,2);
$theSponsorName = $memberDetails->getMemberPartsUsingPeopleId($sponsorId,6);
$affiliatelink = str_replace("backend","frontend", \yii\helpers\Url::toRoute(['/site/index','sponsor'=>$memberNo],true));
?>
 <H3>Hello <?= Html::encode($theSponsorName) ?>,</H3>
    
    <p>Congratulations from Knowledgetoearn.com. </p>
<p>Your sponsored member <?= Html::encode($theSponsorName) ?>, with Member # <?= $memberNo ?>, has successfully upgraded to <?= $package ?> package.</p>

<p>This means that you have earned upgrade sponsorship bonus besides Binary and Matching bonuses. Continue to encourage all those you have sponsored to upgrade and pay monthly subscription to continue earning.</p>
<p>We at Knowledgetoearn.com, once again, wish you all the best in your business.</p>
<h4>Income Disclaimer.</h4>
<p>Please note that the Knowledgetoearn.com opportunity offers unlimited income potential from application of the knowledge given through the platform and also from the affiliate membership. However, Knowledgetoearn.com does not make any guarantee of success.</p>
 





