<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\Tblcycleearnings */

$this->title = Yii::t('app', 'Create Tblcycleearnings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblcycleearnings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblcycleearnings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
