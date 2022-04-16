<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use SocialShareButton;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    
    <span class="thelogo img-responsive"><img src="../web/images/knowledge_to_earn_Logo1.jpg"   height="100px"></img></span>
    
        <?php
    NavBar::begin([
        'brandLabel' => '',//Html::img("../web/images/knowledge_to_earn_Logo1.jpg",['class'=>'thelogo','height'=>'100px']),//Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about'],'items'=>[
            ['label' => 'Terms and Conditions', 'url' => ['/site/termsandconditions']],
            ['label' => 'Privacy Policy', 'url' => ['/site/privacypolicy']],
        ]],
        ['label' => 'Services', 'url' => ['/site/services']],
        ['label' => 'Opportunity', 'url' => ['/site/opportunity']],
        //['label' => 'Events', 'url' => ['/site/events']],
        ['label' => 'FAQ', 'url' => ['/site/faq']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Join', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        
        if(Yii::$app->memberdetails->isRegistered(Yii::$app->userdetails->getPersonId(Yii::$app->user->id)) ) {
            $menuItems[] = ['label' => 'Dashboard', 'url' => ['/dashboard/default/index']];
        }
          $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }   
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <div class="row topbanner">
           
        </div>
        
        <div class="row">
            <div class="col-md-1 lftmargin">

            </div>
            <div class="col-md-10" >   
                <?= $content ?>
            </div>
            <div class="col-md-1 rgtmargin">


            </div>    
        </div>     
    </div>
</div>
    <div class="sitemap">
        <?= $this->render('_sitemap')?>
    </div>
<footer class="footer">
    <div class="container">
        <p class="pull-left"><?= Html::encode(Yii::$app->params['copyright1']) ?>&copy; <?= date('Y') ?> <?=Html::encode(Yii::$app->params['copyright2']) ?></p>

        <!--<p class="pull-right"><?= Yii::powered() ?></p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
