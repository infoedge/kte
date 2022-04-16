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
    <h4 style="color: #900"><?= Html::encode($model->msg) ?></h4>
    <?= $this->render('_form_1', [
        'model' => $model,
    ]) ?>

</div>
<?php
$script = <<< JS
$(function (){
         
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
    /*$('#packregistration-pmethod').change(function(){
        var pmethod= $('#packregistration-pmethod option:selected').val();
        
        alert('Payment Method: ' + pmethod);
        if(pmethod==5){
            var memid = $('#packregistration-member option:selected').val();
            $.get('index.php?r=payments/inpayments/check-gcodes',
                    { memid : memid }
                    function(data){
                        var response = $.parseJSON(data);
                        //alert('data: '+ response.amount);
                        $('#packregistration-package').val(response.package);
                    });
            }
        
    });*/
 });
JS;
$this->registerJs($script);
?>