<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\Sponsorship */

$this->title = Yii::t('app', 'Create Sponsorship');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sponsorships'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sponsorship-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
