<?php
use app\modules\training\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = "Disadvantages Of Entrepreneurship";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;

AppAsset::register($this);
?>
<div class="training-default-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= \yii2assets\pdfjs\PdfJs::widget([
        'url'=> Url::base().'/../modules/training/files/entrepreneurship/Entre005_Disadvantages_Of_Entrepreneurship.pdf',
        'buttons'=>[
            'presentationMode' => false,
            'openFile' => false,
            'print' => false,
            'download' => false,
            'viewBookmark' => true,
            'secondaryToolbarToggle' => false
          ],
        'height'=> '800px',
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