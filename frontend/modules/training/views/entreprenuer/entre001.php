<?php
use app\modules\training\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = "Who is an Entreprenuer?";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
AppAsset::register($this);
?>
<div class="training-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= \yii2assets\pdfjs\PdfJs::widget([
        'url'=> Url::base().'/../modules/training/files/entrepreneurship/Entre001_Who_Is_An_Entrepreneur.pdf',
        'buttons'=>[
            'presentationMode' => false,
            'openFile' => false,
            'print' => false,
            'download' => false,
            'viewBookmark' => true,
            'secondaryToolbarToggle' => false
          ],
        'height'=> '800px',
        //'password' => 'KTECOPYRIGHT'
      ]); ?>
</div>
<?php
$script = <<< JS
$(function (){
        //alert('@pdf Viewer');
    $(".pdf-container").pdfviewer();
});
JS;
$this->registerJs($script);
?>