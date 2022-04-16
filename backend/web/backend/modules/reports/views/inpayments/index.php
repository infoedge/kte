<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\reports\models\InpaymentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inpayments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inpayments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Inpayments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'member',
            'package',
            'ptype',
            'amount',
            //'pdate',
            //'pMethod',
            //'transactionNo',
            //'confirmed',
            //'confirmBy',
            //'confirmDate',
            //'comments',
            //'recordDate',
            //'recordBy',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
