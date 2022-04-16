<?php
$this->title = "Genealogy";



use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
//use frontend\modules\dashboard\models\Genealogy;

//LocalAssets::register($this);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard-membership-genealogy">

    <h1 ><?= $this->title ?></h1>
    
    
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
                $this->render('_showdiagram_2', [
                    'genealogy' => $genealogy,
                    
                ])
                ?>
            
        </div>
        <div class="col-md-2 pull-right stats">
            <?= 
                $this->render('_form_1',[
                    'membership' => $membership,
                ])?>
                        
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
    $('#goSearch').click(function(){
        var memno = $('#membership-searchmember').val();
        alert('Go Search ' + memno );
//        $.post("index.php?r=genealogy/membership/validate-member",
//             { memno : memno  },
//             function(data){
//                   var  result = $.parseJSON(data);
//                   alert(result.message);
//                   //alert(data);
//                   //$('select#people-city').html(data);
//        });

    });
 });
JS;
    $this->registerJs($script);
    ?>
