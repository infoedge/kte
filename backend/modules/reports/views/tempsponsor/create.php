<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\Tempsponsor */

$this->title = 'Create Tempsponsor';
$this->params['breadcrumbs'][] = ['label' => 'Tempsponsors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempsponsor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
