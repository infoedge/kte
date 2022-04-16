<?php
$this->title = "Dashboard";

use frontend\assets\LocalAssets;
use yii\helpers\Html;
use \yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use \Eddmash\Clipboard\Clipboard;

$this->registerLinkTag([
//'title' => 'Live News for Yii',
    'rel' => 'stylesheet',
//'type' => 'application/rss+xml',
    'href' => 'https://unpkg.com/treeflex/dist/css/treeflex.css',
]);
LocalAssets::register($this);
?>
<div class="dashboard-default-index">
    <div class="page-header col-md-offset-1">
        <h1 ><?= $this->title ?></h1>
    </div>
    <div class="row">
        <div class="col-md-2 summary" >
            
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
                        <td><span id="sponsor"><?= $membership->memberNo ?></span></td>
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
                        <td><?= $membership->noSponsered; ?></td>
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
            
            <h2>Links</h2>
            <p>Marketing</p>
            <p>Select placement with respect to sponsor you would like new member to join</p>
            <?php $form = ActiveForm::begin(); ?>
                
            <?= $form->field($model,'placement')->radioList( [1=>'Left',0=>'Right'])?>
            <?= $form->field($model, 'position')->textInput() ?>
            
            <div class="form-group">
            <?=  Html::submitButton(Yii::t('app', 'Update link') , ['class' =>  'btn btn-success' ]) ?> 
            </div>    
            
            <?php ActiveForm::end(); ?>
            <hr>
            <p>Payments</p>
            <hr>

        </div>

        <div class="col-md-7 centerpiece " >
            <h2 style="align-content: center">genealogy</h2>
            <?=
            $this->render('_form', [
                'orgchart' => $orgchart,
            ])
            ?>
            <strong>Note: </strong>Place mouse over picture to see the member's name
            <div class="tf-tree">


                <?= $mytree ?>
            </div>

        </div>
        <div class="col-md-2 pull-right stats">
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
                        <td>Yesterday</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>This Week</td>
                        <td>0</td>
                    </tr>
                     <tr>
                        <td>This Month</td>
                        <td>0</td>
                     </tr>
                    <tr>
                        <td>Last Month</td>
                        <td>0</td>
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
        </div><!--End stats -->
    </div>
 <?php
$script = <<< JS
$(function (){
         
    $('#dashboard-placement').change( function(){
        var pos = $('#dashboard-placement').find('input[type=radio]:checked').val();
        var sponsorno = $('#sponsor').html();
        alert('sponsorNo: '+ sponsorno + 'reading Placement: '+ pos);
        $.get('index.php?r=dashboard/default/create-link',
             { sponsorno : sponsorno , pos : pos },
             function(data){
                var response = $.parseJSON(data);
                alert(response.mylink);
                $('#dashboard-position').val(response.mylink);
            });
    });
      
 });
JS;
$this->registerJs($script);
?>   
</div>
