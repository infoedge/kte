<?php
use yii\widgets\ActiveForm;


$this->registerLinkTag([
//'title' => 'Live News for Yii',
    'rel' => 'stylesheet',
    //'type' => 'application/rss+xml',
    'href' => 'https://unpkg.com/treeflex/dist/css/treeflex.css',
]);
?>
<div class="membership-showtree">
    <div class="tf-tree" style="text-align: center">
        <table border="0" ">
            <thead>
                <tr>
                    <th style="; font-size: 1.5em"><strong>Note: </strong></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td style="text-align: left; font-size: 1.5em">Place mouse over picture to see the member's name</td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: left; font-size: 1.5em">Click on member number to place new member under them. The popup window will allow change of sponsors No</td>
                </tr>
            </tbody>
        </table>
        <br>
            
            
            <?php $form = ActiveForm::begin(); ?>
            <div class="tf-tree">
                <?= $genealogy->treeList/*'Show genealogy Here'*/ ?>
            </div>
            <?php ActiveForm::end(); ?>    
   </div>
    
</div>

