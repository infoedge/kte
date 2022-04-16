<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Pointtrxtypes */

$this->title = Yii::t('app', 'Update Transaction Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Config'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Add Transaction Types'), 'url' => ['create']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pointtrxtypes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
