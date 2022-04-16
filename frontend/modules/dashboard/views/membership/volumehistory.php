<?php
$this->title = "Volume History";

use yii\helpers\Html;
use \yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard-membership-volumehistory">

    <h1 ><?= $this->title ?></h1>
    <div class="row">
        <div class="col-sm-9" >
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    //member',
                    [
                        'label'=>'Member From',
                        'value'=>'memberFrom0.sponsorship.membershipNo',
                        ],
                    [
                        'label'=>'Left',
                        'value'=>'lft',
                        ],
                    [
                        'label'=>'Right',
                        'value'=>'rgt',
                        ],
                    'earnDate',
                //'cyclesValid',
                //'comment',
                //'trxDate',
                //'trxBy',
                //['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
        <div class="col-md-2 pull-right stats">

        </div>
    </div>
</div>
