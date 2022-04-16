<?php
$this->title = "Genealogy";



use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

//LocalAssets::register($this);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Select Member'), 'url' => ['/dashboard/default/memberselect']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard-membership-genealogy">

    <h1 ><?= $this->title ?></h1>
    <h3><?='Member Name: '.$curMem->memberName?></h3>
    
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
            <h3>Action</h3>
            <?= Html::a(Html::encode('Back to Top'), ['/dashboard/membership/genealogy','memberId'=>Yii::$app->session['memberId']],['class'=>'btn btn-block btn-primary']) ?>
            
            <hr>
            
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
