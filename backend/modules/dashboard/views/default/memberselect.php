<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use backend\modules\dashboard\models\People;

$this->title = 'Member Select';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <?php $form=ActiveForm::begin()?>
    
    <?= $form->field($model, 'member')->dropDownList(ArrayHelper::map(People::find()->all(),'id','FullName'),['prompt'=>'--Choose Member --']) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Go to Dashboard'), ['class' => 'btn btn-success']) ?>
    </div>
    <div class="row">
        <div class="col-sm-4">
            PackId: <span id="packId"></span><br>
            Cycle Points: <span id="cyclepoints"></span><br>
            Sponsored Left: <span id="lftSponsored"></span><br>
            Sponsored Right: <span id="rgtSponsored"></span><br>
            Fully Sponsored: <span id="sponsored"></span><br>
        </div>
        <div class="col-sm-4">
            
        </div>
        <div class="col-sm-4">
            
        </div>
    </div>
        
    <?php    ActiveForm::end()?>
</div>
<?php
$script = <<< JS
$(function(){
    $('#memberselect-member').change(function(){
        var memberId = $(this).val();
        
        //alert("MemberId: " + memberId) ;
        $.get("index.php?r=dashboard/default/check-pack-id",
             { memberId : memberId  },
             function(data){
                   var result= $.parseJSON(data);
                   //alert(result);
                   //alert(data);
                   $('#packId').html(result);
                    ////
                    var packId = result;
                   //alert("packId: " + packId) ;
                    $.get("index.php?r=dashboard/default/check-cycle-points",
                         { packId : packId  },
                         function(data){
                               var cyclepoints= $.parseJSON(data);
                               //alert(result);
                               //alert(data);
                               $('#cyclepoints').html(cyclepoints);
                               
                    });

        ///////////////
             $.get("index.php?r=dashboard/default/check-fully-sponsored",
             { memberId : memberId  },
             function(data){
                   var sponsored= $.parseJSON(data);
                   //alert(result);
                   //alert(data);
                   $('#sponsored').html(sponsored);
            });
            $.get("index.php?r=dashboard/default/check-lft-sponsored",
             { memberId : memberId  },
             function(data){
                   var lftSponsored= $.parseJSON(data);
                   //alert(result);
                   //alert(data);
                   $('#lftSponsored').html(lftSponsored);
            });
            $.get("index.php?r=dashboard/default/check-rgt-sponsored",
             { memberId : memberId  },
             function(data){
                   var rgtSponsored= $.parseJSON(data);
                   //alert(result);
                   //alert(data);
                   $('#rgtSponsored').html(rgtSponsored);
            });
        });
        var packId=$('#packId').html();
        
    });
});
JS;
$this->registerJs($script);
?>
