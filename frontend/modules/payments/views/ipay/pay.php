<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\modules\payments\models\People;
use frontend\modules\payments\models\Paymenttypes;
use frontend\modules\payments\models\Packages;
use frontend\modules\payments\models\Ipychannels;

$this->title = "iPay Details";
?>
<h1> Confirm iPay Details </h1>
<?php
$form = ActiveForm::begin([
            //'action' => 'https://payments.ipayafrica.com/v3/ke',
        ]);
?>
<div class="row">
    <div class="col-sm-3">
<?= $form->field($model, 'memberId')->dropDownList(ArrayHelper::map(People::find()->where(['id' => $model->memberId])->all(), 'id', 'FullName'), ['disabled' => 'disabled']) ?>
    </div>
    <div class="col-sm-2">
<?= $form->field($model, 'trxId')->dropDownList(ArrayHelper::map(Paymenttypes::find()->all(), 'id', 'ptypeName'), ['disabled' => 'disabled']) ?>
    </div>
    <div class="col-sm-2">
<?= $form->field($model, 'packId')->dropDownList(ArrayHelper::map(Packages::find()->all(), 'id', 'packName'), ['disabled' => 'disabled']) ?>
    </div>
    <div class="col-sm-3">
<?= $form->field($model, 'dateStart')->textInput(['disabled' => 'disabled']) ?>
    </div>
    <div class="col-sm-2">
<?= $form->field($model, 'amount')->textInput(['disabled' => 'disabled']) ?>
    </div>
</div>
<div class="row">
    <?= $myroute ?>
</div>
<!--<div class="row">
        <?php foreach ($dataArr as $key => $value) { ?>
        <div class="col-sm-3">
            <?= Html::input('text', $key, $value); ?>
        </div>
<?php } ?>
</div>
<?= Html::input('text', 'hsh', $generated_hash) ?>-->
<div class="row">
    <div class="col-md-8 col-sm-offset-1">

<?= $form->field($model, 'channel')->radioList(ArrayHelper::map(Ipychannels::find()->where(['id'=>[1,3,4,6,7,14]])->all(), 'id', 'channelName')) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4 col-sm-offset-1" id="mobno">
    <?= $form->field($model, 'mobileNo')->textInput(['placeholder'=>'e.g 07XXXXXXXX']) ?>
    </div>
</div>

<!--<?= $form->field($model, 'bc_trx_id')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'trxNo')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'statusDate')->textInput() ?>

<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'dest_tag')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'confirms_needed')->textInput() ?>-->

<!--<INPUT name="hsh" type="text" value="<?= $generated_hash ?>">-->
<div class="form-group">
    <div class="col-sm-2">
        <?= Html::submitButton(Yii::t('app', 'Pay'), ['class' => 'btn btn-success btn-block', 'name' => 'btn1', 'value' => 1]) ?>
    </div>
    <div class="col-sm-2">
        <?= Html::a(Yii::t('app', 'Cancel'),Url::previous() ,['class' => 'btn btn-success btn-block', 'name' => 'btn1', 'value' => 2]) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
<?php
$script = <<< JS
$(function (){
    $('#mobno').hide();   
    $('#pay-channel').change( function(){
        var chn=$("#pay-channel").find('input[type=radio]:checked').val();
        var memberid = $('#pay-memberid').children("option:selected").val();
        //alert("Channel: "+ chn + "; memberId: " + memberid);
        
            if(chn==1 || chn==3){ 
                $.get("index.php?r=payments/ipay/fetch-phone-no",
                { memberid : memberid  },
                 function(data){
                       var  result = $.parseJSON(data);
                       //alert(result);
                       //alert(data);
                       $('#pay-mobileno').val(result);
                });
               $('#mobno').show(); 
            }else{
                $('#mobno').hide() ;
            }
            
    });
         
});
JS;
$this->registerJs($script);
?>