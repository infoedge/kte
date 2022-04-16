<?php
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Select Member'), 'url' => ['/dashboard/default/memberselect']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dashboard'), 'url' => ['/dashboard/default/index','memberId'=>Yii::$app->session['memberId'] ]];

$this->title = "Commissions";

use yii\helpers\Html;
use \yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\jui\Tabs;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard-membership-commissions">

    <h1 ><?= $this->title ?></h1>
    <h3><?='Member Name: '.$membership->memberName?></h3>
    <div class="row">
        <div class="col-md-9">
            
            <?= Tabs::widget([
                'items'=>[
                    [
                        'label'=>'Referral Bonus',
                        'content'=>GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    //'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        //'id',
                                        //'sponsor',
                                        [
                                            'attribute'=>'From Member No',
                                            'value'=>'memberFrom0.sponsorship.membershipNo',
                                            ],
                                        //'bonusType0.bonusTypeName',
                                        [
                                            'attribute'=>'Sponsorship Level',
                                            'value'=>'relLevel',
                                            ],
                                        [
                                            'attribute'=>'Amount Earned($)',
                                            'value'=>'points',
                                            ],
                                        [
                                            'attribute'=>'Date Earned',
                                            'value'=>'recordDate',
                                            ],
                                        //'recordBy',
                                        'cashInDate',
                                        //'CashInBy',

                                       // ['class' => 'yii\grid\ActionColumn'],
                                    ],
                                ])],
                        [
                            'label'=>'Binary Bonus',
                            'content'=> GridView::widget([
                                        'dataProvider' => $dataProvider2,
                                        //'filterModel' => $searchModel2,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],

                                            //'id',
                                            //'member',
                                            
                                            'cycles',
                                            'amount',
                                            'earnDate',
                                            //'calcMatchBonus',
                                            [
                                                'attribute'=>'Cash in Date',
                                                'value'=>'trxToWalletDate',
                                                ],
                                            //'trxToWalletBy',

                                            //['class' => 'yii\grid\ActionColumn'],
                                        ],
                                    ]), 
                            
                        ],
                        [
                            'label'=>'Matching Bonus',
                            'content'=> GridView::widget([
                                'dataProvider' => $dataProvider3,
                                //'filterModel' => $searchModel3,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    //'id',
                                    //'member',
                                    //'rank',
                                    'memberFrom',
                                    'amount',
                                    [
                                            'attribute'=>'Date Earned ',
                                            'value'=>'recordDate',
                                        ],
                                    //'recordBy',
                                    [
                                            'attribute'=>'Cash-In Date',
                                            'value'=>'transferDate',
                                        ],

                                    //['class' => 'yii\grid\ActionColumn'],
                                ],
                            ]),
                        ],
                        [
                            'label'=>'Rank Advancement',
                            'content'=>GridView::widget([
                                        'dataProvider' => $dataProvider4,
                                        //'filterModel' => $searchModel4,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],

                                            //'id',
                                            //'member',
                                            'rankAchieved',
                                            //'amount',
                                            [
                                                'attribute'=>'Date Reached',
                                                'value'=>'recordDate',
                                                ],
                                            //'cashInDate',
                                            //'cashInBy',
                                            
                                            //'recordBy',

                                            //['class' => 'yii\grid\ActionColumn'],
                                        ],
                                    ]),
                        ],
                        
                    
                    ],
                    'options' => ['tag' => 'div'],
                    'itemOptions' => ['tag' => 'div'],
                    'headerOptions' => ['tag' => 'h3'],
                    'clientOptions' => ['collapsible' => false],
                ]);
            
            ?>
        </div>
        <div class="col-md-2 pull-right stats">
            <h3 style="text-align: center">Transfer Pending Earnings To Wallet</h3>
            <?php $form = ActiveForm::begin(); ?>
            
            <div class="form-group">
                <p>Pending sponsor bonus US $<?= $fmt->asDecimal($membership->SponsorBonusPending,2) ?><p>
                <?= Html::submitButton(Yii::t('app', 'Sponsor Bonus'), ['class' => 'btn btn-success btn-block','value'=>1,'name'=>'btn']) ?><br>
                <p>Pending Binary Bonus US $<?= $fmt->asDecimal($membership->binaryBonusPending,2) ?><p>
                <?= Html::submitButton(Yii::t('app', 'Binary Cycles Bonus'), ['class' => 'btn btn-success btn-block','value'=>2,'name'=>'btn']) ?><br>
                <p>Pending Matching Bonus US $<?= $fmt->asDecimal($membership->matchingToWalletPending,2) ?><p>
                <?= Html::submitButton(Yii::t('app', 'Matching Bonus'), ['class' => 'btn btn-success btn-block','value'=>3,'name'=>'btn']) ?>
            </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


