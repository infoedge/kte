<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use backend\modules\payments\models\Paymenttypes;
use backend\modules\payments\models\Paymethods;
use backend\modules\payments\models\Sponsorship;
use backend\modules\payments\models\Packages;
use backend\modules\payments\models\People;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Inpayments */
/* @var $form ActiveForm */
$this->title = Yii::t('app', 'Confirm Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Config'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Check Payments'), 'url' => ['checkpay']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="inpayments-confirmpay">

    <?php $form = ActiveForm::begin(); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <h5><?= 'MemberId: '.$memberId=$model->member?></h5>
    <!--<h5><?= 'UserId: '.$userId=$userDetails->getUserParts($memberId) ?></h5>
    <h5><?= 'sponsorNo: '. $sponsorNo=$memberDetails->getTempSponsorDetails($userId) ?></h5>
    <h5><?= 'side: '.$side=$memberDetails->getTempSponsorDetails($memberId,2); ?></h5>
    <h5><?= 'SponsorId: '.$sponsorId=$memberDetails->getMemberPartsUsingMemberNo($sponsorNo) ?></h5>
    <h5><?= 'ParentNo: '.$parentNo=$memberDetails->getTempSponsorDetails($userId,3); ?></h5>
    <h5><?= 'ParentId: '.$parentId = $memberDetails->getTempSponsorDetails2($memberId,3)>0?$memberDetails->getMemberPartsUsingMemberNo($memberDetails->getTempSponsorDetails2($memberId,3)):$sponsorId; ?></h5>
    <h5><?= 'Parenting Method: '.$parMethod=$memberDetails->getTempSponsorDetails($memberId,4); ?></h5>

    <h5><?= 'TrialParent: '.$trialParent = $memberDetails->getParent($sponsorId,$parentId,$pos=$side==1?1:2);?></h5>
    <h5><?= 'Suitable Parent: '.$parent= $memberDetails->confirmSuitableParent($sponsorId,$parentId);//>0?$memberDetails->getParent($sponsorId,$parentId,$side==1?1:2):$sponsorId;; ?></h5>
    <h5><?= 'Is There child on'.$pos.' side?: '.$memberDetails->getChildParts($parentId, $pos,3)?></h5>
    <h5><?= 'Package: '.$packId=$model->package ?></h5>
    <h5><?= 'Cycle Amount: '.$memberDetails->getPackageConfig($packId,3/*upgrade*/,3)?></h5>
    <h5><?= 'No of cildren for Parent: '.$memberDetails->getChildren($parent)?></h5>
    <h5><?= 'Position: '.$position = $memberDetails->getNextPosition($parent,$side); ?></h5>
    
    <h5><?= 'The Date: '.$theDate = date('Y-m-d H:i:s'); ?></h5>
    <h5><?= 'Sponsor Pack: '.$sPack= $memberDetails->getMembershipHistory($sponsorId,$theDate, 4) ?></h5>
    <h5><?= 'Sponsor Rank: '.$sRank= $memberDetails->getMembershipHistory($sponsorId,$theDate, 3) ?></h5>
    <h5><?= 'Member Pack: '.$mPack= $memberDetails->getMembershipHistory($memberId,$theDate, 4) ?></h5>
    <h5><?= $bonusType=1 ?></h5>
    <h5><?= 'Referral Bonus Lev 1: '. $memberDetails->getReferralBonus($bonusType, $sPack, $sRank, $mPack, 1/*$level*/) ?></h5>-->
    <!--<h5><?php print_r($arr1=$memberDetails->getAllLeaves($parentId,$side)) ?></h5>
    <h5><?php print_r($arr2=$memberDetails->getAllLeaves($parent,$side,2)) ?></h5>
    <h5><?php print_r($arr3= array_merge($arr2,$arr1)) ?></h5>
    <h5><?php print_r($arr3= array_unique($arr3)) ?></h5>
    <h5><?php foreach($arr3 as $myparent){    echo 'Parent: '.$myparent.' Children #: '. $memberDetails->getChildren($myparent).'; ';} ?></h5>-->
    <h5><?= 'Level: '.$level = $memberDetails->getMemberPartsUsingPeopleId($memberId, 4); ?></h5>
        <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'member')->dropDownList(ArrayHelper::map(People::find()->all(), 'id', 'FullName'), ['disabled' => 'disabled']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'ptype')->dropDownList(ArrayHelper::map(Paymenttypes::find()->all(), 'id', 'ptypeName'), ['disabled' => 'disabled']) ?>
        </div>




    </div>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'package')->dropDownList(ArrayHelper::map(Packages::find()->all(), 'id', 'packName'),['prompt'=> '--Select preferred Package--', 'disabled' => 'disabled']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'pMethod')->dropDownList(ArrayHelper::map(Paymethods::find()->all(), 'id', 'methodName'),['prompt'=>'--Select payment method--', 'disabled' => 'disabled']) ?>
        </div>
        
        <div class="col-sm-3">
            <?= $form->field($model, 'transactionNo')->textInput(['maxlength' => true , 'disabled' => 'disabled']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'amount')->textInput(['disabled' => 'disabled'] ) ?>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-offset-1 col-sm-3">
            <?= $form->field($model, 'confirmed')->radioList( [1=>'Yes',0=>'No']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'comments')->textarea( ) ?>
        </div>
    </div>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- inpayments-confirmpay -->
