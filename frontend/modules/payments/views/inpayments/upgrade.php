<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Inpayments */

$this->title = Yii::t('app', 'Indicate Payment');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inpayments'), 'url' => ['default']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inpayments-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form_3', [
        'model' => $model,
    ]) ?>

</div>
<?php
$script = <<< JS
$(function (){
    $('#mybitcoinGold').hide();
    $('#mybitcoinDiamond').hide();
    $('#mybitcoin').hide();
    $('#trxns-field').hide(); 
    $('#main-btn').hide();
    //$('#mypaypal').hide();
    $('#myrates').hide();
        $('#myipay').hide();     
    $('#packregistration-package').change( function(){
        var packid = $(this).val();
        var ptype = $('#packregistration-ptype').val();
        //alert("Package: " + packid + "; Trx Type: " + ptype);
        $.get('index.php?r=payments/inpayments/pack-value',
             { packid : packid , ptype : ptype },
             function(data){
                var response = $.parseJSON(data);
                //alert('data: '+ response.amount);
                    $('#packregistration-amount').val(response.amount);
        });
                  
    });
    $('#inpayments-pmethod').change( function(){
        var packid = $('#inpayments-package option:selected').val();
        var pmethod = $('#inpayments-pmethod option:selected').val();
        
        if(!packid || isNaN(packid)) {
            alert('There must be a value for Package!');
            $('#inpayments-package').focus();
            $('#myrates').hide();
        }else {
            pmethod==4 && packid==1? $('#mybitcoinGold').show(): $('#mybitcoinGold').hide();
            pmethod==4 && packid==2? $('#mybitcoinDiamond').show(): $('#mybitcoinDiamond').hide();
            pmethod==4? $('#mybitcoin').show(): $('#mybitcoin').hide();
            pmethod==5? $('#trxns-field').show(): $('#trxns-field').hide();
            pmethod==5? $('#main-btn').show(): $('#main-btn').hide();
            /*pmethod==9? $('#mypaypal').show(): $('#mypaypal').hide();*/
            pmethod==11? $('#myipay').show(): $(input[id^='mybitcoin']).hide();
            $('#myrates').show();
        }
    });
    $('#bcBtn').click( function(){
        var amt = $('#inpayments-amount').val();
        var memid = $('#inpayments-member option:selected').val();
        $.get('index.php?r=payments/inpayments/bcoin-payment',
             { memid : memid , amt : amt },
             function(data){
                var response = $.parseJSON(data);
                //alert('data: '+ response.amount);
                    $('#myresult').html(response);
        });
       
    });  
 });
JS;
$this->registerJs($script);
?>