<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\payments\models\TblwithdrawalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Withdrawals List');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wallet'), 'url' => ['/dashboard/wallet/index']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblwithdrawal-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?= Html::a(Yii::t('app', 'Back to Wallet'),['/dashboard/wallet/index'],['class'=>'btn btn-primary']) ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'member',
            'withdrawalType0.typeName',
            'accountNo',
            'withdrawalCode',
            'amount',
            //'requestBy',
            'requestDate',
            'status0.statusName',
            //'approvedBy',
            'approvedDate',
            //'recordBy',
            //'recordDate',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
