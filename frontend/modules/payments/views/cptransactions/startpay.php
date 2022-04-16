<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Cptransactions */

$this->title = Yii::t('app', 'Pay Using Bitcoin');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['inpayments/packregistration']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cptransactions-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <h2>Either</h2>
    <div class="row">
        <div class="col-sm-5 highlight-border">      
            <h3>Use CoinPayments</h3>
            <ol type="1">
                <li>Click Here <form action="https://www.coinpayments.net/index.php" method="post" target="_blank">
                        <input type="hidden" name="cmd" value="_pay_simple">
                        <input type="hidden" name="reset" value="1">
                        <input type="hidden" name="merchant" value="<?= Yii::$app->params['cpMerchantId'] ?>">
                        <input type="hidden" name="item_name" value="<?= Yii::$app->memberdetails->getPackageFromValue($model->amount,$model->trxId,3) ?>">
                        <input type="hidden" name="invoice" value="<?= 'btc'.time()?>">
                        <input type="hidden" name="currency" value="USD">
                        <input type="hidden" name="amountf" value="<?= Yii::$app->formatter->asDecimal($model->amount,8) ?>">
                        <input type="hidden" name="want_shipping" value="0">
                        <input type="hidden" name="success_url" value="https://localhost/kteprod/frontend/web/index.php?r=payments/inpayments/awaitapproval">
                        <input type="hidden" name="cancel_url" value="https://localhost/kteprod/frontend/web/index.php?r=payments/inpayments/packregistration2&amp;member=<?= $model->memberId ?>">
                        <input type="hidden" name="ipn_url" value="https://localhost/kteprod/frontend/web/index.php?r=payments/cptransactions/status">
                        <p><input type="image" src="https://www.coinpayments.net/images/pub/buynow-wide-blue.png" alt="Buy Now with CoinPayments.net"></p>
                    </form>
                </li>
                <?php $form=ActiveForm::begin()  ?>
                <li> Fill in the field below from CoinPayments after clicking complete payment or from email sent to you from Coinpayments<br>
                            <?= $form->field($model, 'bc_trx_id')->textInput() ?>
                            
  
                </li>
                <li>
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Confirm Transaction'), ['class' => 'btn btn-success']) ?>
                    </div>
                </li>
                <?php ActiveForm::end() ?>
            </ol>

            
            
            </div>
            
            
            
        <div class="col-sm-2" style="text-align: center">      
            <h2>OR</h2>
        </div>
        <div class="col-sm-5 highlight-border">      
            <h3>Use <a href='https://www.blockchain.com/wallet?utm_campaign=dcomnav_wallet' target="_blank">Blockchain Wallet</a></h3>
            <p>Send Payment to Blockchain Wallet No: </p>
            <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?=Yii::$app->params['blockChainWallet'] ?></strong>
            </p>
            <hr>
        <h4>On completion of payment send email, SMS, or WhatsApp message containing:    <ul type="square">
                <li>The site name 'Knowledgetoearn.com'</li>
                <li>Your email</li>
                <li>Transaction #</li>
            </ul>
             to +254-708 497 447, or info@knowledgetoearn.com. </h4>
        </div>
        
    </div>
    <div class="row">
        
    </div>
    <hr>
</div>
<?php
$script = <<< JS
$(function(){
    
});    
JS;
$this->registerJs($script);
?>