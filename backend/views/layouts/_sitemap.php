<?php
use yii\helpers\Html;
?>
<div class="sitemsp">
        
        <div class="row">
            <h4 style="text-align: center">Site Map</h4>
            <div class="col-sm-3">
                <h5>About</h5>
                <?= Html::a('About Us',['site/about']); ?><br>
                <?= Html::a('FAQ',['site/faq']); ?>
            </div>
            <div class="col-sm-3">
                <h5>Products and Services</h5>
                <?= Html::a('Services',['site/services']); ?><br>
                <?= Html::a('Opportunity',['site/opportunity']); ?>
            </div>
            <div class="col-sm-3">
                <h5>Action</h5>
                <?= Html::a('Contact Us',['site/contact']); ?><br>
                <?= Html::a('Join',['site/join']); ?>
            </div>
        </div>
    </div>
