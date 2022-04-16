<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\Contacttypes */

$this->title = Yii::t('app', 'Add Contact Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Basic Info'), 'url' => ['default/index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contact types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacttypes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h3>Listed Contact Types</h3>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'contacttypeName',
            //'recordBy',
            //'recordDate',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}'],
        ],
    ]); ?>
</div>
