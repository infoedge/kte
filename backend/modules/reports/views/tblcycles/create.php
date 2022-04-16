<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\Tblcycles */

$this->title = 'Create Tblcycles';
$this->params['breadcrumbs'][] = ['label' => 'Tblcycles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblcycles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
