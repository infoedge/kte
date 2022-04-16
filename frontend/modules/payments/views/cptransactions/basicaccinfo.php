<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Cptransactions */

$this->title = Yii::t('app', 'CoinPayments Transaction');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['inpayments/packregistration']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cptransactions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_2', [
        'model' => $model,
    ]) ?>
<?php !empty($result)? print_r($result):'' ?>
</div>
