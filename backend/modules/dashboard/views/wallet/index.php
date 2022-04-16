<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\payments\models\WalletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Wallet');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wallet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3><?='Member Name: '.$membership->memberName?></h3>
    <p>
        <!-- <?= Html::a(Yii::t('app', 'Create Wallet'), ['create'], ['class' => 'btn btn-success']) ?>-->
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
        <div class ="col-md-9">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    //'member',
                    'fromTable',
                    'trxDate',
                    'trxMethod0.methodName',
                    [
                        'label'=>'Gift code',
                        'value'=>'trxId',
                        ],
                        
                    'trxDir',
                    'amount',
                //'recordDate',
                //'recordBy',
                // ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>

        </div>
        <div class="col-md-2 pull-right stats">
        <?php $form = ActiveForm::begin(); ?>   
            <h3>Wallet Balance</h3>
            <h4 style="text-align: center; color: red"><?= $fmt->currencyCode.$fmt->asDecimal($membership->walletBal,2) ?></h4>
            <h3>Gift Codes</h3>
            <?= Html::a(Yii::t('app', 'Generate Gift Code'), ['/payments/gcodes/create'], ['class' => 'btn btn-success btn-block']) ?>
            <hr>
            <h3>Transfer Funds</h3>
            <?= Html::a(Yii::t('app', 'Transfer Details'), ['/payments/fundstransfer/create'], ['class' => 'btn btn-success btn-block']) ?>
            <hr>
            <h3>Receive Funds</h3>
            <?= Html::submitButton(Yii::t('app', 'Recieve Funds'),  ['class' => 'btn btn-success btn-block', 'id'=>'rcvFunds','name'=>'btn','value'=>1,'disabled'=>empty($trxCode)?'disabled':null]) ?>
             
        <?php ActiveForm::end(); ?>
            </div>
    </div>
</div>
<?php
$script = <<< JS
$(function (){
    
    
        $('#rcvFunds').click(function(){
        //alert('Got  to Receive funds');
        var memid = $('#membership-memberid').val()
        $.get('index.php?r=payments/fundstransfer/receive-funds-transfer',
             { memid : memid  },
             function(data){
                var response = $.parseJSON(data);
                alert('data: '+ response.amount);
                    
        });      
     }); 
      
 });
JS;
    $this->registerJs($script);
    ?>