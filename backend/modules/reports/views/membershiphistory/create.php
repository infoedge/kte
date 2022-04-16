<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\Membershiphistory */

$this->title = 'Create Membershiphistory';
$this->params['breadcrumbs'][] = ['label' => 'Membershiphistories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membershiphistory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
