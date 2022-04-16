<?php

namespace backend\modules\basic\assets;

use yii\web\AssetBundle;

/**
 * Description of PayrollAssets
 *
 * @author Apache1
 */
class BasicAssets extends AssetBundle {
    public $sourcePath='@app/modules/basic/assets';
    public $css = [
        'css/site.css',
        'css/local.css',
    ];
    public $js = [
        'js/members.js',
        
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
