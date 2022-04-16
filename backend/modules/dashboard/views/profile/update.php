<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\People */

$this->title = Yii::t('app', 'Profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Select Member'), 'url' => ['/dashboard/default/memberselect']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dashboard'), 'url' => ['/dashboard/default/index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', $this->title);
?>
<div class="people-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3><?='Member Name: '.$membership->memberName?></h3>
    <?php
        Modal::begin([
            'header' => '<h2>e-mail</h2>',
            'id' => 'modal',
            'size' => 'modal-sm',
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
        ?>
    <?= $this->render('_form_1', [
        'model' => $model,
    ]) ?>

</div>
<?php
$script = <<< JS
$(function (){
    
    //alert('Got  to popup');
        $('[id^="lnk"]').click(function(){
        //alert('Got  to popup2');
            $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
        
     });
});
JS;
$this->registerJs($script);
?>
        