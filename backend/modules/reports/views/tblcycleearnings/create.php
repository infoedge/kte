<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\Tblcycleearnings */

$this->title = 'Create Tblcycleearnings';
$this->params['breadcrumbs'][] = ['label' => 'Tblcycleearnings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblcycleearnings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
