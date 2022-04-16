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
      
 });
JS;
$this->registerJs($script);
?>