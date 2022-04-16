<?php
namespace backend\modules\myrbac\assets;

use \yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MyrbacAsset extends AssetBundle
{

        public $sourcePath='@app/modules/myrbac/assets';
        public $css = [
        ];
        public $js = [
        ];
        public $image = [
            'Login1'=>'images/Login1.png',
            'LoginRequired4' => 'images/LoginRequired4.jpg',
        ];
}