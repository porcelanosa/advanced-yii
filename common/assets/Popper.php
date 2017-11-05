<?php

namespace common\assets;

use yii\web\AssetBundle;

class Popper extends AssetBundle
{
    public $sourcePath = '@bower/popper.js/dist/umd';
    /*public $css = [
        'css/popper.min.css',
    ];*/
    public $js = [
        'popper.min.js',
    ];
    public $depends = [
        //'yii\web\JqueryAsset',
    ];
}
