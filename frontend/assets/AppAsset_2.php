<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset_2 extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $sourcePath='@app/assets';
    public $css = [
        'css/site.css',
        'css/local.css',
        'css/pdfviewer.css'
    ];
    public $js = [
        'js/pdfviewer.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
