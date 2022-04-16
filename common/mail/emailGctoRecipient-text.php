<?php
use yii\helpers\Html;
use yii\helpers\Url;

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
$giftCodeExpiryDate = $memberDetails->getAppConstant('GiftCodeExpiryDate');
$recipientsEmail= $memberDetails->getGCodeById($gcId,6);
$recipientName = $userDetails->getUserPartsByUsername($recipientsEmail,5);
$packName = $memberDetails->getPackageFromPrefix(substr($giftcode,0,3),2);
?>
<h2>Dear <?= $recipientName ?>,</h2>
<p>Congratulations! You have received a gift code no '<?= $giftcode ?>' from <?= $memberName ?>, worth US $ <?= $giftcodeAmt  ?> in order to complete registration at <?= str_replace('%2F','/', Url::toRoute(['/site/login'],true)) ?>.</p>
<p>Please, therefore, login and at the payment page, select package type <i>'<?=$packName ?>'</i> then copy and paste the gift code number above to the space provided and register.</p>
<p>The Gift code is valid until <?= $giftCodeExpiryDate ?>.</p>
<p>We at Knowledgetoearn.com wish you all the best in your engagement with us.</p>
