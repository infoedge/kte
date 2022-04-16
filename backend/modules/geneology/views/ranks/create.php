<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\genealogy\models\Ranks */

$this->title = Yii::t('app', 'Manage Ranks');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ranks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ranks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h2>Existing Ranks</h2>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'rankName',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
