<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\reports\models\InpaymentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daily Activity';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reports'), 'url' => ['/reports/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inpayments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'JoinDate',
            'GoldRegCount',
            'GoldRegAmt',
            'GoldSubsCount',
            'GoldSubsAmt',
            'DiamondRegCount',
            'DiamondRegAmt',
            'DiamondUpgCount',
            'DiamondUpgAmt',
            'DiamondSubsCount',
            'DiamondSubsAmt',
            'TotCount',
            'TotAmt',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
