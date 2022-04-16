<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Constantunits */

$this->title = Yii::t('app', 'Create Constantunits');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Constantunits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="constantunits-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
