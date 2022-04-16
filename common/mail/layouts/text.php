<?php

use yii\helpers\Html;

/** @var \yii\web\View $this view component instance */
/** @var \yii\mail\MessageInterface $message the message being composed */
/** @var string $content main view render result */
?>

<?php $this->beginPage() ?>
<?php $this->beginBody() ?>
<H2>Knowledge to Earn</H2>
<h3>Learn, Share, Earn</h3>
<?= $content ?>
<p>For any Queries;</p>
    <p style="text-align:center">Email: support@knowledgetoearn.com</p>
    <p style="text-align:center">Website: www.knowledgetoearn.com</p>
    <p style="text-align:center">
        <span><a href="https://www.facebook.com/Knowledgetoearncom-105224028230578/" target="_blank" rel="noreferrer noopener">Facebook</a></span
                <span><a href="https://www.linkedin.com/company/knowledgetoearn" target="_blank" rel="noreferrer noopener">LinkedIn</a></span>
                <span><a href="https://mobile.twitter.com/Knowledgetoear1"  target="_blank" rel="noreferrer noopener">Twitter</a></span>       
                <span><a href="https://youtube.com/channel/UCtL2COhQF9H9asbbxsK4Jzw"  target="_blank" rel="noreferrer noopener">YouTube</a></span>
                <span><a href="https://www.instagram.com/p/CKWYvjmBZl5/?igshid=1rlmcwi5mpbv8"  target="_blank" rel="noreferrer noopener">Instagram</a></span>
    </p>
<?php $this->endBody() ?>
<?php $this->endPage() ?>
