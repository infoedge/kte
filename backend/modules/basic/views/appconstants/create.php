<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Appconstants */

$this->title = Yii::t('app', 'Add Application Constants');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Application Constant List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appconstants-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_2', [
        'model' => $model,
    ]) ?>

<?php
$script = <<< JS
$(function (){
         
    $('#addConstantUnits').click( function(){
        $(this).attr("src","images/plussign-pushed.png");
         $.get('index.php?r=basic/constantunits/create');
         alert('Clicked AddConstantUnits Button');
    });
 });
JS;
$this->registerJs($script);
?>
</div>
