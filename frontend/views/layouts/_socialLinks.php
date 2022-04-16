<?php
use yii\helpers\Url;
use yii\helpers\Html;

$getreq = Yii::$app->request;
?>
<div class="_socialLinks">
<span><a href="https://www.facebook.com/Knowledgetoearncom-105224028230578/" target="_blank" rel="noreferrer noopener"><img src="images/facebook1.png"  height="48px" title="Facebook"/></a></span>
                    <span><a href="https://www.linkedin.com/company/knowledgetoearn" target="_blank" rel="noreferrer noopener"><img src="images/linkedin1.png"  height="48px" title="LinkedIn"></a></span>
                    <span><a href="https://mobile.twitter.com/Knowledgetoear1"  target="_blank" rel="noreferrer noopener"><img src="images/twitter1.png" height="48px" title="Twitter"></a></span>       
                    <span><a href="https://youtube.com/channel/UCtL2COhQF9H9asbbxsK4Jzw"  target="_blank" rel="noreferrer noopener"><img src="images/youtube1.png" height="48px" title="YouTube"></a></span>
                    <span><a href="https://www.instagram.com/p/CKWYvjmBZl5/?igshid=1rlmcwi5mpbv8"  target="_blank" rel="noreferrer noopener"><img src="images/instagram1.jpg" height="48px" title="Instagram"></a></span>
                    <span id="telno"><img src="images/whatsApp.jpg" height="52px" title="+254708497447"></span>
                    <span><?= Html::a("Register", !empty($getreq->get('sponsor'))?Url::to(['/site/join', 'sponsor' => $getreq->get('sponsor')]):Url::to(['/site/signup']),['class'=>'btn btn-danger btn-lg']) ?></span>
</div>