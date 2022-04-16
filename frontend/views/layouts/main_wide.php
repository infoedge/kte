<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
        <?php $getreq = Yii::$app->request ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <!--<div class="wrap">-->
        <div class="container-fluid">

<!--<span class="thelogo img-responsive"><img src="<?= Url::to(['/images/knowledge_to_earn_Logo1.jpg']) ?>"   height="100px"/></span>-->
            <span class="thelogo img-responsive"><img src="images/knowledge_to_earn_Logo1.jpg"   height="100px"/></span>

<?php
NavBar::begin([
    'brandLabel' => '', //Html::img("../web/images/knowledge_to_earn_Logo1.jpg",['class'=>'thelogo','height'=>'100px']],//Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
$menuItems = [
    ['label' => 'Home', 'url' => Url::home('https')],
    ['label' => 'About', 'url' => ['/site/about'], 'items' => [
            ['label' => 'About Us', 'url' => ['/site/about']],
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
    $menuItems[] = ['label' => 'Register', 'url' => ['/site/join', 'sponsor' => $getreq->get('sponsor')]];
    $menuItems[] = ['label' => 'My Account', 'url' => Url::to(['/site/login'], 'https')];
} else {

    if (Yii::$app->memberdetails->isRegistered(Yii::$app->userdetails->getPersonId(Yii::$app->user->id))) {
        $menuItems[] = ['label' => 'Dashboard', 'url' => Url::to(['/dashboard/default/index'], 'https')];
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

            <div class="container-fluid">
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
                <?= Alert::widget() ?>

                <div class="row topbanner">
                    .<div class="ticker-wrap">
                        <div class="ticker">
                            <div class="ticker__item">Letterpress chambray brunch.</div>
                            <div class="ticker__item">Vice mlkshk crucifix beard chillwave meditation hoodie asymmetrical Helvetica.</div>
                            <div class="ticker__item">Ugh PBR&B kale chips Echo Park.</div>
                        </div>
                    </div>
                </div>
                <div class="sociallinks col-sm-offset-7">
                    <!--<span><a href="https://www.facebook.com/Knowledgetoearncom-105224028230578/" target="_blank" rel="noreferrer noopener"><img src="<?= Url::to(['/images/facebook1.png'], true) ?>"  height="48px" title="Facebook"/></a></span>
                    <span><a href="https://www.linkedin.com/company/knowledgetoearn" target="_blank" rel="noreferrer noopener"><img src="<?= Url::to(['/images/linkedin1.png'], true) ?>"  height="48px" title="LinkedIn"></a></span>
                    <span><a href="https://mobile.twitter.com/Knowledgetoear1"  target="_blank" rel="noreferrer noopener"><img src="<?= Url::to(['/images/twitter1.png'], true) ?>" height="48px" title="Twitter"></a></span>       
                    <span><a href="https://youtube.com/channel/UCtL2COhQF9H9asbbxsK4Jzw"  target="_blank" rel="noreferrer noopener"><img src="<?= Url::to(['/images/youtube1.png'], true) ?>" height="48px" title="YouTube"></a></span>
                    <span><a href="https://www.instagram.com/p/CKWYvjmBZl5/?igshid=1rlmcwi5mpbv8"  target="_blank" rel="noreferrer noopener"><img src="<?= Url::to(['/images/instagram1.jpg'], true) ?>" height="48px" title="Instagram"></a></span>-->

                    <span><a href="https://www.facebook.com/Knowledgetoearncom-105224028230578/" target="_blank" rel="noreferrer noopener"><img src="images/facebook1.png"  height="48px" title="Facebook"/></a></span>
                    <span><a href="https://www.linkedin.com/company/knowledgetoearn" target="_blank" rel="noreferrer noopener"><img src="images/linkedin1.png"  height="48px" title="LinkedIn"></a></span>
                    <span><a href="https://mobile.twitter.com/Knowledgetoear1"  target="_blank" rel="noreferrer noopener"><img src="images/twitter1.png" height="48px" title="Twitter"></a></span>       
                    <span><a href="https://youtube.com/channel/UCtL2COhQF9H9asbbxsK4Jzw"  target="_blank" rel="noreferrer noopener"><img src="images/youtube1.png" height="48px" title="YouTube"></a></span>
                    <span><a href="https://www.instagram.com/p/CKWYvjmBZl5/?igshid=1rlmcwi5mpbv8"  target="_blank" rel="noreferrer noopener"><img src="images/instagram1.jpg" height="48px" title="Instagram"></a></span>
                    <span id="telno"><img src="images/whatsApp.jpg" height="52px" title="+254708497447"></span>


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
            <?= $this->render('_sitemap') ?>
        </div>
        <footer class="footer">

            <div class="container">

<?= Html::encode(Yii::$app->params['copyright1']) ?>&copy;  <?= Html::encode(Yii::$app->params['copyright2']) ?></p>

        <!--<p class="pull-right"><?= Yii::powered() ?></p>-->
            </div>
        </footer>
        <!--</div>-->
<?php $this->endBody() ?>
    </body>
<?php
$script = <<< JS
    $(function (){
         $('#telno').click(function(){
            alert('WhatsApp # +254 708 497 447');
        });   
    });
JS;
$this->registerJs($script);
?>
</html>
    <?php $this->endPage() ?>
