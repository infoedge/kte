<?php
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kongoon\orgchart\OrgChart;

$this->registerLinkTag([
//'title' => 'Live News for Yii',
    'rel' => 'stylesheet',
//'type' => 'application/rss+xml',
    'href' => 'https://unpkg.com/treeflex/dist/css/treeflex.css',
]);

?>
<div class="membership-showtree">
    <div class="row"> 
            <div class="col-md-7" style='font-size: 1.3em'>
                <h3><strong>Note: </strong></h3>
                <ol type="1">
                    <li>Place mouse over image to see the member's name</li>
                <li>Click on the image to view the genealogy tree starting from member clicked.</li>
                <li>Click on Member No to view popup to select marketing link.</li>
                </ol>
            </div>
            <div class="col-md-5">
                <br><br>
                <h4><strong>Legend </strong></h4>
                <p><img src='images/Person17.jpg' title='Member Sponsored by You' style='margin-right: 10px'>Member Sponsored by You</p>
                <p><img src='images/Person14.jpg' title='Member Sponsored by another member' style='margin-right: 10px'>Member Sponsored by another member</p>
            </div>
    </div>
    
    <div class="tf-tree" style="text-align: center">
        
        <br>
            <?php $form = ActiveForm::begin(); ?>
            <?php Pjax::begin() ?>
            <div class="tf-tree" >
                
                <p><?= $genealogy->treeList ?></p>
            </div>
            <?php Pjax::end() ?>
            <?php ActiveForm::end(); ?>    
   </div>
    
</div>

