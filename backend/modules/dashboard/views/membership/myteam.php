<?php
$this->title = "My Team";

use yii\helpers\Html;
use \yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Select Member'), 'url' => ['/dashboard/default/memberselect']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dashboard'), 'url' => ['/dashboard/default/index','memberId'=>Yii::$app->session['memberId'] ]];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard-membership-myteam">

    <h1 ><?= $this->title ?></h1>
    <h3><?='Member Name: '.$membership->memberName?></h3>
    <div class="row">
        <div class ="col-md-9">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                    'attribute'=>'Member Name',
                    'value'=>'member0.FullName',
                        ],
                    [
                        'attribute'=>'Package',
                        'value'=>'currentMemberhistory.package.packName',
                        ],
                    'status0.Status',
                    [
                        'attribute'=>'Rank',
                        'value'=>'currentMemberhistory.rank0.rankName',
                        ],
                    'membershipNo',
                    'member0.phoneNo',
                    'member0.user.email',
                    

                ],
            ])
            ?>
        </div>
        <div class="col-md-2 pull-right stats">

        </div>
    </div>

</div>
