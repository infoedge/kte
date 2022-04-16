<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LocalAssets extends AssetBundle
{
    public $sourcePath='@app/assets';
    public $css = [
        'css/local.css',
    ];
    public $js = [
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
