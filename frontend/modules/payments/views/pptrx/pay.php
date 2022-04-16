<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Pay Via Paypal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pptrx-pay">
    <div class="row">
        <div class="col-sm-offset-3">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="4UE9PAEBLR44E">
                <table>
                    <tr><td><input type="hidden" name="on0" value="Package">Package</td></tr><tr><td><select name="os0">
                                <option value="Gold Package" <?= $optn == 1 ? 'selected' : '' ?>">Gold Package $25.00 USD</option>
                                <option value="Diamond Package" <?= $optn == 2 ? 'selected' : '' ?>>Diamond Package $50.00 USD</option>
                                <option value="Upgrade to Diamond" <?= $optn == 3 ? 'selected' : '' ?>>Upgrade to Diamond $25.00 USD</option>
                            </select> </td></tr>
                </table>
                <input type="hidden" name="currency_code" value="USD">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>

            </p>
        </div>
    </div>
</div>