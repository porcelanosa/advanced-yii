<?php

namespace frontend\assets;

use yii\web\AssetBundle;
    
    /**
 * Main backend application asset bundle.
 */
class LeafletAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/leaflet/leaflet.css',
    ];
    public $js = [
        'js/leaflet.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
