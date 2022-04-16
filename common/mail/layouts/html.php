<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <img src='/images/knowledge_to_earn_Logo.jpg' width='100px' align='center'></img>
    <?= $content ?>
    <p>For any Queries;</p>
    <p style="text-align:center">Email: support@knowledgetoearn.com</p>
    <p style="text-align:center">Website: www.knowledgetoearn.com</p>
    <p style="text-align:center">
        <span><a href="https://www.facebook.com/Knowledgetoearncom-105224028230578/" target="_blank" rel="noreferrer noopener"><img src="images/facebook1.png"  height="48px" title="Facebook"></a></span
                <span><a href="https://www.linkedin.com/company/knowledgetoearn" target="_blank" rel="noreferrer noopener"><img src="images/linkedin1.png"  height="48px" title="LinkedIn"></a></span>
                <span><a href="https://mobile.twitter.com/Knowledgetoear1"  target="_blank" rel="noreferrer noopener"><img src="images/twitter1.png" height="48px" title="Twitter"></a></span>       
                <span><a href="https://youtube.com/channel/UCtL2COhQF9H9asbbxsK4Jzw"  target="_blank" rel="noreferrer noopener"><img src="images/youtube1.png" height="48px" title="YouTube"></a></span>
                <span><a href="https://www.instagram.com/p/CKWYvjmBZl5/?igshid=1rlmcwi5mpbv8"  target="_blank" rel="noreferrer noopener"><img src="images/instagram1.jpg" height="48px" title="Instagram"></a></span>
    </p>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
