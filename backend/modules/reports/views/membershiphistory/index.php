<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\reports\models\MembershiphistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Membershiphistories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membershiphistory-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Membershiphistory', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'memberId',
            'packageId',
            'status',
            'rank',
            //'statusEndDate',
            //'expiryDate',
            //'dateStart',
            //'dateEnd',
            //'recordBy',
            //'recordDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
