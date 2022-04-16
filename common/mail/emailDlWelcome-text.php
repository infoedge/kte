<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$memberDetails=Yii::$app->memberdetails;

$userDetails=Yii::$app->userdetails;
$memberNo = $memberDetails->getMemberPartsUsingPeopleId($memberid);
$phoneNo = $memberDetails->getMemberPartsUsingPeopleId($memberid,15);
$email = $userDetails->getUserParts($memberid,2);
$memberName = $memberDetails->getMemberPartsUsingPeopleId($memberid,6);

?>
<h2>Congratulations!</h2>
<p>You have successfully created a gift code no ??? worth ???.</p>
<p>You may send the Gift Code number to anyone you wish to invite to join this program.</p>
<p>Do NOT forget to send your link with the Gift Code to ensure that the one you send to joins in your network.</p>
<p>The Gift Code can only be used once and, if not used within seven (7)days of generation,
     shall be redeemed and the funds restored to your wallet.</p>

<p>We at Knowledgetoearn.com wish you all the best in your business.</p>
<h3>Income Disclaimer.</h3>
<p>Please note that the Knowledgetoearn.com opportunity offers unlimited income potential from application of the knowledge given through the platform and also from the affiliate membership. However, Knowledgetoearn.com does not make any guarantee of success.</p>




