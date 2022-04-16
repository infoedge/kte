<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Inpayments */

$this->title = Yii::t('app', 'Create Inpayments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inpayments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inpayments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
