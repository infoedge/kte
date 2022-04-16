<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\Placement */
/* @var $form ActiveForm */

//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="placement">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'sponsor') ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'parent') ?>

        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'homelnk')->hiddenInput()->label(false) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'methodstr')->hiddenInput()->label(false) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'pos')->radioList([0 => 'Auto', 1 => 'left', 2 => 'Right']) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'thelnk')->textArea(['rows' => '6']) ?>
        </div>
        
        
 <div class="col-md-12">
     Highlight and copy the link then paste in the browser url area OR  send to your prospect.</div>
    </div>
    <div class="form-group">
        <!--<?= Html::submitButton(Yii::t('app', 'Sponsor Now'), ['class' => 'btn btn-primary']) ?>
        <?= Html::button(Yii::t('app', 'Copy Sponsor Link'), ['class' => 'btn btn-success','id'=>'linkcopy']) ?>-->
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- placement -->
<?php 
$script = <<< JS
$(function (){
    //alert('Got  to popup');
        $('#placement-pos').change(function(){
            var sponsor = $('#placement-sponsor').val();
            var parent = $('#placement-parent').val();
            var lft = $(this).find('input[type=radio]:checked').val();
            var m = $('#placement-methodstr').val();
            var homelnk = $('#placement-homelnk').val();
            $('#placement-thelnk').val(homelnk + '&sponsor=' + sponsor +'&parent=' + parent + '&lft=' + lft + '&m=' + 3);
        });
        $('#linkcopy').click(function(){
            var sponsor = $('#placement-sponsor').val();
            var parent = $('#placement-parent').val();
            var lft = $("#placement-pos").find('input[type=radio]:checked').val();
            var m = $('#placement-methodstr').val();
            var homelnk = $('#placement-homelnk').val();
            $('#placement-thelnk').val(homelnk + '&sponsor=' + sponsor +'&parent=' + parent + '&lft=' + lft + '&m=' + 3);
            var copiedtxt=document.getElementById("placement-thelink");
            copiedtxt.select();
            copiedtxt.setSelectionRange(0,9999);
            document.execCommand("copy");
        });
        
 });
JS;
$this->registerJs($script);
?>