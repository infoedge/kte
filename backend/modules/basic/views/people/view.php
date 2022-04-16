<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\People */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Peoples'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="people-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id, 'people_id' => $model->people_id, 'people_IdentityType' => $model->people_IdentityType], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id, 'people_id' => $model->people_id, 'people_IdentityType' => $model->people_IdentityType], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'titleId',
            'surname',
            'otherNames',
            'firstName',
            'identityNo',
            'IdentityType',
            'nationality',
            'dob',
            'gender',
            'kraPin',
            'people_id',
            'people_IdentityType',
        ],
    ]) ?>

</div>
