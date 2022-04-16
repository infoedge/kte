<?php
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kongoon\orgchart\OrgChart;



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
                
            </tbody>
        </table>
        <br>
            <?php $form = ActiveForm::begin(); ?>
            <?php Pjax::begin() ?>
            <!--<div class="tf-tree">-->
                <?= OrgChart::widget([
                    'data' => $genealogy->treeArr,/*[
                            [['v' => 'Mike', 'f' => '<img src="https://placeholdit.imgix.net/~text?txtsize=20&txt=Mike&w=120&h=150" /><br  /> <strong>Mik</strong><br  />The President'],'', 'The President'],
                            [['v' => 'Jim', 'f' => '<img src="https://placeholdit.imgix.net/~text?txtsize=20&txt=Jim&w=120&h=150" /><br  /><strong>Jim</strong><br  />The Test'],'Mike', 'VP'],
                            [['v' => 'ทดสอบ', 'f' => '<img src="https://placeholdit.imgix.net/~text?txtsize=20&txt=ทดสอบ&w=120&h=150" /><br  /><strong>ทดสอบ</strong><br  />The Test'], 'Mike', ''],
                            [['v' => 'Bob', 'f' => '<img src="https://placeholdit.imgix.net/~text?txtsize=20&txt=Bob&w=120&h=150" /><br  /><strong>Bob</strong><br  />The Test'], 'Jim', 'Bob Sponge'],
                            [['v' => 'Caral', 'f' => '<img src="https://placeholdit.imgix.net/~text?txtsize=20&txt=Caral&w=120&h=150" /><br  /><strong>Caral</strong><br  />The Test'], 'Mike', 'Caral Title'],

                    ]*/
                ]); ?>
            <!--</div>-->
            <?php Pjax::end() ?>
            <?php ActiveForm::end(); ?>    
   </div>
    
</div>

