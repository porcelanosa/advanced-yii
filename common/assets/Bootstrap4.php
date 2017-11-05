<?php

namespace common\assets;

use yii\web\AssetBundle;
    
    class Bootstrap4 extends AssetBundle
{
    public $sourcePath = '@vendor/twbs/bootstrap/dist';
    public $css = [
        //'css/bootstrap.min.css',
    ];
    public $js = [
        'js/bootstrap.bundle.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
