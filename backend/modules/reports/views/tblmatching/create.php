<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\Tblmatching */

$this->title = 'Create Tblmatching';
$this->params['breadcrumbs'][] = ['label' => 'Tblmatchings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblmatching-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
