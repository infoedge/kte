<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\reports\models\TblcycleearningsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tblcycleearnings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblcycleearnings-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tblcycleearnings', ['create'], ['class' => 'btn btn-success']) ?>
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
            'earnDate',
            'cycles',
            'amount',
            //'calcMatchBonus',
            //'trxToWalletDate',
            //'trxToWalletBy',
            //'recordBy',
            //'recordDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
