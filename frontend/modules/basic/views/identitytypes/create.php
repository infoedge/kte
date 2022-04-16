<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\Identitytypes */

$this->title = Yii::t('app', 'Add Identity Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin Switchboard'), 'url' => ['/switchboard/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Basic'), 'url' => ['default/index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Identity Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identitytypes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h3>Listed Types</h3>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'idTypeName',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
