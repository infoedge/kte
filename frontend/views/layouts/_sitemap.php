<?php
use yii\helpers\Html;


$getreq = Yii::$app->request;
?>
<div class="sitemap">
        
        <div class="row">
            <h5 style="text-align: center"><strong>Site Map</strong></h5>
            <div class="col-sm-6 col-md-2 col-md-offset-2">
                <h5>About</h5>
                <?= Html::a('About Us',['site/about']); ?><br>
                <?= Html::a('FAQ',['site/faq']); ?><br>
                <?= Html::a('Privacy Policy',['site/privacypolicy']); ?><br>
            </div>
            <div class="col-sm-6 col-md-2">
                <h5>Opportunity</h5>
                <?= Html::a('Services',['site/services']); ?><br>
                <?= Html::a('Opportunity Overview',['site/opportunity']); ?><br>
                <?= Html::a('Opportunity Presentaion',['/training/default/index']); ?>
            </div>
             <div class="col-sm-6 col-md-2">
                <h5>Social</h5>
                
                <span><a href="https://www.facebook.com/Knowledgetoearncom-105224028230578/" target="_blank" rel="noreferrer noopener">Facebook</a></span><br>
                <span><a href="https://www.linkedin.com/company/knowledgetoearn" target="_blank" rel="noreferrer noopener">LinkedIn</a></span><br>
                <span><a href="https://mobile.twitter.com/Knowledgetoear1"  target="_blank" rel="noreferrer noopener">Twitter</a></span><br>       
                <span><a href="https://youtube.com/channel/UCtL2COhQF9H9asbbxsK4Jzw"  target="_blank" rel="noreferrer noopener">YouTube</a></span><br>
                <span><a href="https://www.instagram.com/p/CKWYvjmBZl5/?igshid=1rlmcwi5mpbv8"  target="_blank" rel="noreferrer noopener">Instagram</a></span><br>
            </div>
            <div class="col-sm-6 col-md-2">
                <h5>Action</h5>
                <?= Html::a('Contact Us',['/site/contact']); ?><br>
                <?= Html::a('Join Us', !empty($getreq->get('sponsor'))?['/site/join', 'sponsor' => $getreq->get('sponsor')]:['/site/signup'])  ?>
            </div>
        </div>
    </div>
