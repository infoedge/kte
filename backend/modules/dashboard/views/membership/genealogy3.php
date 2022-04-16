<?php
$this->title = "genealogy";



use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

//LocalAssets::register($this);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard-membership-genealogy">

    <h1 ><?= $this->title ?></h1>
    <?= $memberDetails->getMemberPartsUsingPeopleId($memberDetails->extremeSide($memberDetails->getMemberPartsUsingMemberNo($placement->sponsor),$placement->pos))?>
    <div class="row">

        <div class="col-md-9">

        <?php
        Modal::begin([
            'header' => '<h2>Placement</h2>',
            'id' => 'modal',
            'size' => 'modal-sm',
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
        ?>
            

                <?=
                $this->render('_showdiagram', [
                    'genealogy' => $genealogy,
                ])
                ?>
            
        </div>
        <div class="col-md-2 pull-right stats">
            <h3 style="text-align: center">Referral Placement</h3>
            <?php $form = ActiveForm::begin(); ?>
    
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($placement, 'sponsor') ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($placement, 'parent') ?>

                    </div>
                    <div class="col-md-12">
                        <?= $form->field($placement, 'pos')->radioList([0 => 'Auto', 1 => 'left', 2 => 'Right']) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($placement, 'homelnk')->hiddenInput()->label(false) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($placement, 'thelnk')->textArea() ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($placement, 'methodstr')->textInput()->label(false) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($placement, 'homelnk')->textInput()->label(false) ?>
                    </div>

                </div>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Sponsor Now'), ['class' => 'btn btn-primary btn-block']) ?><br>
                    <?= Html::button(Yii::t('app', 'Copy Sponsor Link'), ['class' => 'btn btn-success btn-block','id'=>'linkcopy']) ?>
                </div>
                <?php ActiveForm::end(); ?>
        </div>
    
    </div>
<?php
$script = <<< JS
$(function (){
    
    //alert('Got  to popup');
        $('[id^="lnk"]').click(function(){
        //alert('Got  to popup2');
            $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
        
     }); 
    $('#placement-pos').change(function(){
        // alert('Changed Position');
        var sp = $('#placement-sponsor').val();
        var pt = $('#placement-parent').val();
        var pos = $('#placement-pos').find('input[type=radio]:checked').val();
        var homelnk = $('#placement-homelnk').val()
        var mstr = $('#placement-methodstr').val();
        //alert('Sponsor: '+ sp +' ; Parent: ' + pt + ' ;Position: '+ pos);
        $('#placement-thelnk').val( homelnk  + sp + '/' + pt + '/' + pos + '/' + mstr);
    });
    
    $('#linkcopy').click(function(){
        var copiedtxt=document.getElementById("placement-thelnk");
        copiedtxt.select();
        copiedtxt.setSelectionRange(0,9999);
        document.execCommand("copy");
    }); 
 });
JS;
    $this->registerJs($script);
    ?>
