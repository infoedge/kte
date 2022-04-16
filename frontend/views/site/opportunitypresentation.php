<?php
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\widgets\

$this->title='Opportunity Details';

$this->params['breadcrumbs'][] = $this->title;
!empty($refmodel->sponsor)?$this->params['breadcrumbs'][] = "Your Referrer: ".$refmodel->memberName." - Member No: ".$refmodel->sponsor:'';
//https://cdnjs.com/libraries/pdf.js
$this->registerJsFile('http://mozilla.github.io/pdf.js/build/pdf.js');
use app\assets\AppAsset_2;
AppAsset_2::register($this);
?>
<div class="site-opportunity-presentation">
    <?= $this->widget('ext.pdfJs.QPdfJs',
            ['url'=>/*$this->createUrl(*/'/file/kte_opportunity_presentationVer1_0.pdf'/*,['format'=>Files::PDF]
          )])*/]);
            ?>

    <div class="pdf-container" data-href="web/docs/kte_opportunity_presentationVer1_0.pdf"></div>
</div>
<?php
$script = <<< JS
$(function (){
    $(".pdf-container").pdfviewer();
});
JS;
$this->registerJs($script);
?>