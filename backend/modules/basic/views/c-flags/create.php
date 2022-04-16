<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\CFlags */

$this->title = Yii::t('app', 'Add Country Flags');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'C Flags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cflags-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <hr>
    <h3>Listed Country Flags</h3>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            ['attribute'=>'c.Name',],
            'country',
            'countryFlag',

            ['class' => 'yii\grid\ActionColumn',
                'template'=> '{update}',
                ],
        ],
    ]); ?>
</div>
