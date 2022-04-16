<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$memberDetails=Yii::$app->memberdetails;
$userDetails=Yii::$app->userdetails;
$memberNo = $memberDetails->getMemberPartsUsingPeopleId($memberid);
$username = $userDetails->getUserParts($memberid,3);
$memberName = $memberDetails->getMemberPartsUsingPeopleId($memberid,6);
$affiliatelink = str_replace("backend","frontend", \yii\helpers\Url::toRoute(['/site/index','sponsor'=>$memberNo],true));
?>
Hello <?= $memberName ?>,

<p>Welcome to Knowledgetoearn.com. </p>
<p>You now have a great opportunity to better your life through our unparalled content in different areas of your life, i.e. Personal development and Economic development. You also have an opportunity to use our affiliate programme to earn extra income.</p>
<p>Your Details are: </p>
<ul><li>Username: <?= $username ?></li>
<li>Member ID: <?= $memberNo ?></li>
<li>Affiliate link: <?= $affiliatelink ?> </li></ul>
<p>Kindly take time to go through our uploaded content and keep checking for more contents from day to day uploads.</p>
<p>We at Knowledgetoearn.com wishes you all the best in your business.</p>
<h4>Income Disclaimer.</h4>
<p>Please note that the Knowledgetoearn.com opportunity offers unlimited income potential from application of the knowledge given through the platform and also from the affiliate membership. However, Knowledgetoearn.com does not make any guarantee of success.</p>






