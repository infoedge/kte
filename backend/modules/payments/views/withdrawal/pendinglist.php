<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\payments\models\TblwithdrawalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pending Withdrawals');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Config'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="tblwithdrawal-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'member0.FullName',
            'withdrawalType0.typeName',
            'accountNo',
            'withdrawalCode',
            
            'amount',
            'status0.statusName',
            //'requestBy',
            //'requestDate',
            //'approvedBy',
            //'approvedDate',
            //'recordBy',
            //'recordDate',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=> '{confirm}',
                'buttons'=>[
                    'confirm'=> function($url,$model){
                            \yii\helpers\Url::remember();
                            return Html::a( '<span class="glyphicon glyphicon-thumbs-up" id="confirmicon" title="Confirm Payment" ></span>',  ['confirmpay','id'=>$model->id]);
                    },
                ],
            ],
            
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
