<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\People */

$this->title = Yii::t('app', 'Complete Registration');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin Switchboard'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Basic'), 'url' => ['default/index']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="people-create">
<div class="row">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php Pjax::begin(); ?> 
    <?= $this->render('_form', [
        'model' => $model,
        'backlink' => $backlink,
        //'citylist'=>$citylist,
    ]) ?>
    
</div>
    
<?php
$script = <<< JS
$(function (){
    
    $('#people-nationality').change( function(){
        var id = $(this).val();
        
        //alert("Country: " + id) ;
        $.get("index.php?r=basic/people/list-cities",
             { id : id  },
             function(data){
                   //var  result= $.parseJSON(data);
                   //alert(result);
                   //alert(data);
                   $('select#people-city').html(data);
        });
        $.get("index.php?r=basic/people/extract-dialcode",
             { id : id  },
             function(data){
                   var  result= $.parseJSON(data);
                   //alert(result);
                   //alert(data);
                   $('#people-phoneno').val(result);
        });
        $.get("index.php?r=basic/people/extract-flag",
             { id : id  },
             function(data){
                   var  result= $.parseJSON(data);
                   //alert(result);
                   //alert(data);
                   $('#flag').html(result);
        });
    });
    
        $('#people-phoneno').focus(function(){
            var that = this;
            setTimeout(function(){ that.selectionStart = that.selectionEnd = 10000; }, 0);
        });
    $('#people-titleid').change(function(){
        var title = $(this).val()
        if(title==2 || title==4 )
        {
            $('#people-gender').val('2');
        } else if (title ==1)
        {
             $('#people-gender').val('1');
        } else
        {
             $('#people-gender').val('');
        }
    });
 });
JS;
$this->registerJs($script);
?>
</div>
