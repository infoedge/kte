<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\People */

$this->title = Yii::t('app', 'Add Personal Data');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin Switchboard'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Basic'), 'url' => ['default/index']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="people-create">
<div class="row">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'backlink' => $backlink,
    ]) ?>
</div>
    <div class="row">
    <h3>Listed Personal Details</h3>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'title.title',
            'fullName',
            //'otherNames',
            //'surname',
            
             'identityNo',
             'identityType.idTypeName',
            'nationality0.Name',
            // 'dob',
             //'gender',
            // 'kraPin',
            'contactsList',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}',
                ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
    </div>
</div>
<?php
$script = <<< JS
$(function (){
         
    $('#people-nationality').change( function(){
        var id = $(this).val();
        
        alert("Country: " + id ;
        $.get('index.php?r=basic/people/list-cities',
             { id : id  },
             function(data){
                
                    $('select#people-city').html(data);
        });
                  
    });
      
 });
JS;
$this->registerJs($script);
?>