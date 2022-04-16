<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\payments\models\InpaymentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Check Payments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Config'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inpayments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!--<?= Html::a(Yii::t('app', 'Create Inpayments'), ['create'], ['class' => 'btn btn-success']) ?>-->
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'label'=>'Member Name',
                'value' =>'member0.fullName',
                ],
            [
                'label'=>'E-mail',
                'value'=> 'member0.user.email'
                ],
            [
                'label'=> 'Package Name',
                'value' =>'package0.packName',
                ],
            [
                'label'=>'Payment Type',
                'value'=>'ptype0.ptypeName',],
            [
                'label'=>'Pay Method',
                'value'=>'pMethod0.methodName',
                ],
            'transactionNo',
            
            'pdate',
            'amount',
            
            
            //'comments',
            //'recordDate',
            //'recordBy',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=> '{update} &nbsp;&nbsp;{payapprove}',
                'buttons'=>[
                    
                    'payapprove'=> function($url,$model){
                            \yii\helpers\Url::remember();
                            return Html::a( '<span class="glyphicon glyphicon-certificate" id="approveicon" title="Confirm Payment" ></span>',  ['confirmpay','memberId'=>$model->member,'ptype'=>$model->ptype,'package'=>$model->package]);
                    },
                ],

                ],
        ],
    ]); ?>


</div>
