<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\genealogy\models\Sponsorship */

$this->title = Yii::t('app', 'Update Membership: ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manage Membership'), 'url' => ['create']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sponsorship-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_1', [
        'model' => $model,
    ]) ?>

</div>
