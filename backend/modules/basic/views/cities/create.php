<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\Cities */

$this->title = Yii::t('app', 'Add Cities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h3>Listed Cities/Towns</h3>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'city',
            [   
                'attribute'=>'country0.Name',
                ],
            'area',
            'geonameid',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}',
                ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
