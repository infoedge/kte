<?php

use yii\base\View;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$getreq = Yii::$app->request;
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

        <div class="wrap">
<!--<span class="thelogo img-responsive"><img src="<?= Url::to(['/images/knowledge_to_earn_Logo1.jpg']) ?>"   height="100px"/></span>-->
 <!--           <span class="thelogo img-responsive"><img src="images/knowledge_to_earn_Logo1.jpg"   height="100px"/></span>-->

            <?php
            NavBar::begin([
                'brandLabel' => Html::img("../web/images/knowledge_to_earn_Logo1.jpg", ['class' => 'thelogo', 'height' => '100px']), //Yii::$app->name,
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
                $menuItems[] = ['label' => 'Register', 'url' => !empty($getreq->get('sponsor')) ? Url::to(['/site/join', 'sponsor' => $getreq->get('sponsor')]) : Url::to(['/site/signup'])];
                $menuItems[] = ['label' => 'My Account', 'url' => Url::to(['/site/login'], 'https')];
            } else {

                if (Yii::$app->memberdetails->memberHasHistory(Yii::$app->userdetails->getPersonId(Yii::$app->user->id))) {
                    $menuItems[] = ['label' => 'Dashboard', 'url' => Url::to(['/dashboard/default/index'], 'https')];
                    $menuItems[] = ['label' => 'Help', 'url' => Url::to(['/site/help'], 'https')];
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

                <?= $content ?>

            </div>
            <div class="container">
                <div class="row">
                    <div class="bottom-socialLinks col-md-offset-3">
                        <?= $this->render('_socialLinks') ?>
                    </div>
                </div>
                <div class="sitemap bottom-sitemap ">
                        <?= $this->render('_sitemap') ?>
                </div>
                <footer class="footer">

                    <div class="container">

<?= Html::encode(Yii::$app->params['copyright1']) ?>&copy;  <?= Html::encode(Yii::$app->params['copyright2']) ?></p>

        <!--<p class="pull-right"><?= Yii::powered() ?></p>-->
                    </div>
                </footer>
            </div>
        </div>
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