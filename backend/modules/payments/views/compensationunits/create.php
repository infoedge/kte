<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Compensationunits */

$this->title = Yii::t('app', 'Create Compensationunits');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Compensationunits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compensationunits-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
