<?php

namespace app\assets;

use yii\web\AssetBundle;

class FancyboxAsset extends AssetBundle
{
    public $js = [
        'js/fancybox/jquery.fancybox.pack.js',
    ];

    public $css = [
        'js/fancybox/jquery.fancybox.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'app\assets\FontAwesomeAsset',
    ];
}
