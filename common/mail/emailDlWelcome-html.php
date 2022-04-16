<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$memberDetails=Yii::$app->memberdetails;
$userDetails=Yii::$app->userdetails;
$memberNo = $memberDetails->getMemberPartsUsingPeopleId($memberid);
$phoneNo = $memberDetails->getMemberPartsUsingPeopleId($memberid,15);
$email = $userDetails->getUserParts($memberid,2);
$memberName = $memberDetails->getMemberPartsUsingPeopleId($memberid,6);

?>
<div class="memconfirm-email">
<h2>Congratulations!</h2>
<p>You have personally enrolled a new member, and your team is now growing big.</p>
<p>Create time to contact the new member so that you can personally offer a welcoming hand.</p>
<p>Details: </p>
<ul><li>Member ID:<?= Html::encode($memberNo) ?></li>
<li>Email: <?= Html::encode($email) ?></li>
<li>Phone Number:  <?= Html::encode($phoneNo) ?></li>
<li>Name: <?= Html::encode($memberName) ?></li></ul>
<p>We at Knowledgetoearn.com wishes you all the best in your business.</p>
<h3>Income Disclaimer.</h3>
<p>Please note that the Knowledgetoearn.com opportunity offers unlimited income potential from application of the knowledge given through the platform and also from the affiliate membership. However, Knowledgetoearn.com does not make any guarantee of success.</p>

</div>
