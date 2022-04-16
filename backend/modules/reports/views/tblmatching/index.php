<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\reports\models\TblmatchingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tblmatchings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblmatching-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tblmatching', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'member',
            'rank',
            'memberFrom',
            'relLevel',
            //'amount',
            //'trxToWalletBy',
            //'trxToWalletDate',
            //'recordDate',
            //'recordBy',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
