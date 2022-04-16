<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\payments\models\InpaymentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Inpayments');
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
                'label'=>'Payment Type',
                'value'=>'ptype0.ptypeName',],
            'transactionNo',
            'package',
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
                            return Html::a( '<span class="glyphicon glyphicon-certificate" id="approveicon" title="Confirm Payment" ></span>',  ['confirmpay','memberId'=>$model->member]);
                    },
                ],

                ],
        ],
    ]); ?>


</div>
