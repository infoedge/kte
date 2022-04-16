<?php

use yii\helpers\Html;
    $requestItem = Yii::$app->request;
  // Fill these in with the information from your CoinPayments.net account.
    $cp_merchant_id = Yii::$app->params['cpMerchantId'];
    $cp_ipn_secret = Yii::$app->params['cpIpnSecret'];
    $cp_debug_email = Yii::$app->params['adminEmail'];

    //These would normally be loaded from your database, the most common way is to pass the Order ID through the 'custom' POST field.
    $order_currency = 'USD';
    $order_total = Yii::$app->session['amount'];

    function errorAndDie($error_msg) {
        global $cp_debug_email;
        if (!empty($cp_debug_email)) {
            $report = 'Error: '.$error_msg."\n\n";
            $report .= "POST Data\n\n";
            foreach ($requestItem->post() as $k => $v) {
                $report .= "|$k| = |$v|\n";
            }
            mail($cp_debug_email, 'CoinPayments IPN Error', $report);
        }
        die('IPN Error: '.$error_msg);
    }

    if (!empty($requestItem->post('ipn_mode')) || $requestItem->post('ipn_mode') != 'hmac') {
        errorAndDie('IPN Mode is not HMAC');
    }

    if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
        errorAndDie('No HMAC signature sent.');
    }

    $request = file_get_contents('php://input');
    if ($request === FALSE || empty($request)) {
        errorAndDie('Error reading POST data');
    }

    if (!empty($request->post('merchant')) || $request->post('merchant') != trim($cp_merchant_id)) {
        errorAndDie('No or incorrect Merchant ID passed');
    }

    $hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret));
    if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
    //if ($hmac != $_SERVER['HTTP_HMAC']) { <-- Use this if you are running a version of PHP below 5.6.0 without the hash_equals function
        errorAndDie('HMAC signature does not match');
    }

    // HMAC Signature verified at this point, load some variables.
    
    $ipn_type = $requestItem->post('ipn_type');
    $txn_id = $requestItem->post('txn_id');
    $item_name = $requestItem->post('item_name');
    $item_number = $requestItem->post('item_number');
    $amount1 = floatval($requestItem->post('amount1'));
    $amount2 = floatval($requestItem->post('amount2'));
    $currency1 = $requestItem->post('currency1');
    $currency2 = $requestItem->post('currency2');
    $status = intval($requestItem->post('status'));
    $status_text = $requestItem->post('status_text');

    if ($ipn_type != 'button') { // Advanced Button payment
        die("IPN OK: Not a button payment");
    }

    //depending on the API of your system, you may want to check and see if the transaction ID $txn_id has already been handled before at this point

    // Check the original currency to make sure the buyer didn't change it.
    if ($currency1 != $order_currency) {
        errorAndDie('Original currency mismatch!');
    }

    // Check amount against order total
    if ($amount1 < $order_total) {
        errorAndDie('Amount is less than order total!');
    }
 
    if ($status >= 100 || $status == 2) {
        // payment is complete or queued for nightly payout, success
    } else if ($status < 0) {
        //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent
    } else {
        //payment is pending, you can optionally add a note to the order page
    }
    die('IPN OK'); 
    

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Cptransactions */

$this->title = Yii::t('app', 'CoinPayments Transaction Status');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['inpayments/packregistration']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cptransactions-create">

    <h1><?= Html::encode($this->title) ?></h1>
<?=
    'ipn_type '.$ipn_type .'<br>'.
    'txn_id '.$txn_id .'<br>'.
    'item_name '.$item_name .'<br>'.
    'item_number '.$item_number .'<br>'.
    'amount1 '.$amount1 .'<br>'.
    'amount2 '.$amount2 .'<br>'.
    'currency1 '.$currency1 .'<br>'.
    'currency2 '.$currency2 .'<br>'.
    'status '.$status .'<br>'.
    'status_text '.$status_text .'<br>';
    ?>
<?php !empty($result)? print_r($result):'' ?>
</div>
