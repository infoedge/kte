<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\Sponsorship */

$this->title = 'Create Sponsorship';
$this->params['breadcrumbs'][] = ['label' => 'Sponsorships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sponsorship-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
