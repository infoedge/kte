<?php
use app\modules\training\assets\AppAsset;
use yii\helpers\Url;
use \yii\helpers\Html;



$this->title = "What Does Life Entail";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Maximizing Ones Potential'), 'url' => ['/training/maxpotential/index']];
$this->params['breadcrumbs'][] = $this->title;

AppAsset::register($this);
?>
<div class="training-default-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= \yii2assets\pdfjs\PdfJs::widget([
        'url'=> Url::base().'/../modules/training/files/maxpotential/Max001_What_Does_Life_Entail.pdf',
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