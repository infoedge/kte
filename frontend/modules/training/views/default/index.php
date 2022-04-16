<?php
use app\modules\training\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use common\components\YoutubeWidget; 

$this->title = "Opportunity Presentation";

AppAsset::register($this);
?>
<div class="training-default-index">
    <h1><?= Html::encode($this->title) ?></h1>
     
    <?= \yii2assets\pdfjs\PdfJs::widget([
        'url'=> Url::base().'/../modules/training/files/default/kte_opportunity_presentation_ver2_0.pdf',
        'buttons'=>[
            'presentationMode' => false,
            'openFile' => false,
            'print' => false,
            'download' => true,
            'viewBookmark' => true,
            'secondaryToolbarToggle' => false
          ],
        'height'=> '800px',
      ]); ?>
      <hr>
      <?= YoutubeWidget::widget([
            "code"=>"qOp4Y2_g5ZI",
            "w"=>"100%",
            "h"=>"550px",
            ]) ?>
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