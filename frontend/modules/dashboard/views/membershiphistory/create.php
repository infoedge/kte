<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\Membershiphistory */

$this->title = Yii::t('app', 'Create Membershiphistory');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Membershiphistories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membershiphistory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
