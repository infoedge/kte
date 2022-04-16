<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    /*public $sourcePath='@app/assets';*/
    public $css = [
        'css/site.css',
        'css/local.css',
        'css/ticker.css',
        [
            'href' => 'images/kte_device.ico',
            'rel' => 'icon',
            'sizes' => '32x32',
        ],
        [
            'background-image'=>'images/bckground.jpg',
            'alt'  => 'bckground'
        ],
    ];
    public $js = [
        'js/pdfviewer.js',
        'js/showtel.js',
        'js/osgetter.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $images = [
       'images/Gold.jpg',
        'images/diamond.jpg',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        
    ];
}
