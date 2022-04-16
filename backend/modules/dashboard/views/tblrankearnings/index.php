<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\dashboard\models\TblrankearningsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tblrankearnings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblrankearnings-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tblrankearnings'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'member',
            'rankAchieved',
            'amount',
            'cashInDate',
            //'cashInBy',
            //'recordDate',
            //'recordBy',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
