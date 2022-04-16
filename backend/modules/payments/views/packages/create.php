<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Packages */

$this->title = Yii::t('app', 'Add Package');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Config'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h2>Listed Packages</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'packName',
            'dailyCyclesCapping',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}'],
        ],
    ]); ?>
</div>
