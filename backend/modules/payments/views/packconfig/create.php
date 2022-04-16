<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Packconfig */

$this->title = Yii::t('app', 'Configure Package');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Config'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packconfig-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h2>Configured Packages</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'pack.packName',
            'payType0.ptypeName',
            'amount',
            'sponsorPoints',
            'cyclePoints',
            //'recordBy',
            //'recordDate',
            //'changedBy',
            //'changeDate',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' =>'{upgrade}',
                ],
        ],
    ]); ?>
</div>
