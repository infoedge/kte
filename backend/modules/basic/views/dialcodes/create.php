<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\Dialcodes */

$this->title = Yii::t('app', 'Add Dialcodes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dialcodes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dialcodes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <hr>
    <h3>Listed Dial codes</h3>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            ['attribute'=>'c.Name',],
            'countryCode',
            'exitCode',
            'trunkCode',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{uplate}',
                ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
