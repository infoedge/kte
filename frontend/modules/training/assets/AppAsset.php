<?php

namespace app\modules\training\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $sourcePath='@app/modules/training/assets/';
    public $css = [
        'css/pdfviewer.css'
    ];
    public $js = [
        'js/pdfviewer.js',
        'js/default.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}