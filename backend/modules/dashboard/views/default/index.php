<?php
$this->title = "Dashboard";

use frontend\assets\LocalAssets;
use yii\helpers\Html;
use \yii\widgets\Pjax;
use yii\widgets\ActiveForm;


$this->registerLinkTag([
//'title' => 'Live News for Yii',
    'rel' => 'stylesheet',
//'type' => 'application/rss+xml',
    'href' => 'https://unpkg.com/treeflex/dist/css/treeflex.css',
]);
LocalAssets::register($this);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Select Member'), 'url' => ['/dashboard/default/memberselect']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard-default-index">
    <div class="page-header col-md-offset-1">
        <h1 ><?= $this->title ?></h1>
        <h3><?='Member Name: '.$membership->memberName?></h3>
    </div>
    <div class="row">
        
        <div class="col-md-3 summary" >
            <?php $form = ActiveForm::begin(); ?>
            <h3>Member Details</h3>
            <table class="table table-responsive table-striped" border="0" cellpadding="3">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Member Name :</strong></td>
                        <td><?= $membership->memberName; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Join Date :</strong></td>
                        <td><?= $membership->joinDate; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td> <?= $membership->status; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Member No:</strong></td>
                        <td><span id="memberno"><?= $membership->memberNo ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Package:</strong></td>
                        <td><?= $membership->packageName ?></td>
                    </tr>
                    
                    <tr>
                        <td><strong>Rank:</strong></td>
                        <td><?= $membership->memberRank ?></td>
                    </tr>
                    <tr>
                        <td><strong>Total # Sponsored:</strong></td>
                        <td><?= $membership->noSponsored; ?></td>
                    </tr>
            
                </tbody>
            </table>
            
            <h3>Sponsor</h3>
            <table class = "table table-responsive table-striped" border="0" >
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Name :</strong></td>
                        <td><?= $membership->sponsorName; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Member #:</strong></td>
                        <td><?= $membership->sponsorNo; ?></td>
                    </tr>
                </tbody>
            </table>
            <!--<?= 'Valid Cycles Time Limit: '. Yii::$app->params['validCyclePointsTimeLimit'].'<br>';?>
            
            <?= 'Member ID: '.$membership->memberId;?><br>
            <?= 'Left: '.Yii::$app->memberdetails->getMemberPartsUsingPeopleId($membership->memberId, 8) ?><br>
            <?= 'Right: '.Yii::$app->memberdetails->getMemberPartsUsingPeopleId($membership->memberId, 7) ?><br>
            <?= 'bottom Left: '.$membership->bottomLeft ?><br>
            <?= 'bottom right: '.$membership->bottomRight ?><br>
            <h4>Cycles</h4>
            <?= 'Level: '.$memberDetails->getMemberPartsUsingPeopleId($membership->memberId,4) ?><br>
            <?= 'Parent: '.$memberDetails->getMemberPartsUsingPeopleId($membership->memberId,2) ?><br>
            <?= 'Package: '.$thepackage=$memberDetails->getMembershipHistory($membership->memberId,$membership->joinDate,4) ?><br>
            <?= 'Amount: '.$memberDetails->getPackageConfig($thepackage, 1, 3) ?><br>-->
            <!--<h3>Members Per Level</h3>
            <table class="table table-responsive table-striped"  border="0">
                <thead>
                    <tr>
                        <th>Level</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($membership->levelCount as $i => $arr) {?>
                    <tr>
                        <td><?= "<strong>". $i . "</strong>" ?></td>
                        <td><?= $arr ?></td>
                    </tr>
                    <?php }?>
                    
                </tbody>
            </table>-->


            
            <hr>
            
            
            

        </div>

        <div class="col-md-3 centerpiece " >
            <h2 style="align-content: center"></h2>
            <h3>Sponsorship Bonus</h3><table class="table table-responsive table-striped" border="0" width="0">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Amount ($)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pending:</td>
                        <td><?= $membership->pointsPending; ?></td>
                    </tr>
                    <tr>
                        <td>Paid:</td>
                        <td><?= $membership->pointsPaid; ?></td>
                    </tr>
                    <tr>
                        <td>Balance</td>
                        <td><?= $membership->pointsBal.' ',$membership->pointsBalSide>0?($membership->pointsBalSide==1?'on the Left':'on the Right' ):'' ?> </td>
                    </tr>

                    <tr>
                        <td><strong># Sponsored</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        
                        <td>&nbsp;Left</td>
                        <td><?= $membership->noSponsoredLft ?></td>
                        
                    </tr>
                    <tr>
                        
                        <td>&nbsp;Right</td>
                        <td><?= $membership->noSponsoredRgt ?></td>
                        
                    </tr>

                </tbody>
            </table>

            <hr>
            <h3>Team Bonus</h3>
            <table class ="table table-responsive table-striped" border="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Total Cycles Paid:</strong></td>
                        <td><?= $membership->cyclesPaid; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Pending Cycles:</strong></td>
                        <td><?= $membership->cyclesPending; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Pending Left:</strong></td>
                        <td><?= $membership->binaryLftPending; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Pending Right:</strong></td>
                        <td><?= $membership->binaryRgtPending; ?></td>
                    </tr>
                </tbody>
            </table>
            <hr>
        </div>
        <div class="col-md-3 centerpiece2">
            <h3>Matching Bonus</h3>
            <table class="table table-responsive table-striped" border="0">
                <thead>
                    <tr>
                        <th>Time Frame</th>
                        <th>Amount Earned ($)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Earned</td>
                        <td><?= $fmt->asDecimal($membership->matchingAll,2) ?></td>
                    </tr>
                    <tr>
                        <td>Today</td>
                        <td><?= $fmt->asDecimal($membership->matchingToday,2) ?></td>
                    </tr>
                    <tr>
                        <td>Yesterday</td>
                        <td><?= $fmt->asDecimal($membership->matchingYesterday,2) ?></td>
                    </tr>
                    <tr>
                        <td>This Week</td>
                        <td><?= $fmt->asDecimal($membership->matchingThisWeek,2) ?></td>
                    </tr>
                     <tr>
                        <td>Last Week</td>
                        <td><?= $fmt->asDecimal($membership->matchingLastWeek,2) ?></td>
                     </tr>
                     <tr>
                        <td>This Month</td>
                        <td><?= $fmt->asDecimal($membership->matchingThisMonth,2) ?></td>
                     </tr>
                    <tr>
                        <td>Last Month</td>
                        <td><?= $fmt->asDecimal($membership->matchingLastMonth,2) ?></td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <h3>Rank Advancement</h3>
            <table class="table table-responsive table-striped" border="0">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Date Achieved</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-2 pull-right stats">
            <h2>Action</h2>
                <?php if($membership->packId==1){
                echo Html::a('Upgrade', ['/payments/inpayments/upgrade', 'member'=>$membership->memberId,'ptype'=>3,'packId'=>$membership->packId +1], ['class'=>'btn btn-success btn-block']);
            }?>
            <?php if($membership->status!=='Active'){
                echo Html::a('Subscription', ['/payments/inpayments/reactivate', 'member'=>$membership->memberId,'ptype'=>2,'package'=>$membership->packId], ['class'=>'btn btn-warning btn-block']);
                }?>
            <hr>
            <h2>Links</h2>
            <p>Marketing</p>
            <p>Select placement, with respect to sponsor, you would like new member to join on</p>
            
                
            <?= $form->field($model,'placement')->radioList( [0=>'Auto',1=>'Left',2=>'Right'])?>
            <?=  Html::submitButton(Yii::t('app', 'Set Default Placement') , ['class' =>  'btn btn-success','id'=>'btn1', 'name'=>'btn' , 'value'=>3 ]) ?> 
            <?= $form->field($model, 'position')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'lftside')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'rgtside')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'pMethodStr')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'thelink')->textArea() ?>
            <div class="form-group">
            <?=  Html::button(Yii::t('app', 'Copy link') , ['class' =>  'btn btn-success btn-block','id'=>'linkcopy' ]) ?> 
            </div>    
            
            <?php ActiveForm::end(); ?>
        </div><!--End stats -->
    </div>
 <?php
$script = <<< JS
$(function (){
         
    $('#dashboard-placement').change( function(){
        var pos = $('#dashboard-placement').find('input[type=radio]:checked').val();
        var baseurl = $('#dashboard-position').val();
        var lftend = $('#dashboard-lftside').val();
        var rgtend = $('#dashboard-rgtside').val();
        var pmethod = $('#dashboard-pmethodstr').val();
        //alert('BaseUrl: '+ baseurl + 'Leftend: '+ lftend + '; RightEnd: ' + rgtend + '; Pos: ' + pos);
        if( pos == 1){
            $('#dashboard-thelink').val(baseurl + lftend + pos + pmethod);
        }else {
            $('#dashboard-thelink').val(baseurl + rgtend + pos + pmethod);
        }
        
    });
    $('#linkcopy').click(function(){
        var copiedtxt=document.getElementById("dashboard-thelink");
        copiedtxt.select();
        copiedtxt.setSelectionRange(0,9999);
        document.execCommand("copy");
    }); 
    
//    $('#btn1').click(function(){
//        var pos=$('#dashboard-placement').find('input[type=radio]:checked').val();
//        var memberno = $('#memberno').html();
//        alert('Member no: '+memberno + ' ;Position: ' + pos);
//        $.get("index.php?r=dashboard/default/alter-pref-position",
//             { memberno : memberno , pos : pos  },
//             function(data){
//                   //var  result= $.parseJSON(data);
//                   //alert(result);
//                   alert(data);
//                  // $('select#people-city').html(data);
//        });
//   });
 });
JS;
$this->registerJs($script);
?>   
</div>
