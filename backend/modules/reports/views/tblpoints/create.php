<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\Tblpoints */

$this->title = 'Create Tblpoints';
$this->params['breadcrumbs'][] = ['label' => 'Tblpoints', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblpoints-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
