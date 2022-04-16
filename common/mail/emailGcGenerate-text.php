<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$memberDetails=Yii::$app->memberdetails;
$userDetails=Yii::$app->userdetails;
$memberNo = $memberDetails->getMemberPartsUsingPeopleId($memberId);
$phoneNo = $memberDetails->getMemberPartsUsingPeopleId($memberId,15);
$email = $userDetails->getUserParts($memberId,2);
$memberName = $memberDetails->getMemberPartsUsingPeopleId($memberId,6);
$giftcode = $memberDetails->getGCodeById($gcId);
$giftcodeAmt = $memberDetails->getGCodeById($gcId,3);
$giftCodeValidDays = $memberDetails->getAppConstant('GiftCodeExpiryPeriod');
?>
<h2>Dear <?= $memberName ?></h2>
<p>You have successfully generated a Gift Code No <?= $giftcode  ?> worth US $ <?= $giftcodeAmt  ?></p>
<p>The amount has been deducted from your wallet, while all Gift codes generated and status may be viewed on the Gift code page.</p>
<p>The Gift code is valid for <?= $giftCodeValidDays ?> days, after which it shall become invalid and the value be restored to your wallet.</p>
<p>By sending this code to whoever you wish along with your marketing link, you will have enabled them to become a member. </p>

<p>We at Knowledgetoearn.com wish you all the best in your engagement with us.</p>
<h3>Income Disclaimer.</h3>
<p>Please note that the Knowledgetoearn.com opportunity offers unlimited income potential from application of the knowledge given through the platform and also from the affiliate membership. However, Knowledgetoearn.com does not make any guarantee of success.</p>
