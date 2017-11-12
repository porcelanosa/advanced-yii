<?php

namespace frontend\assets;

use yii\web\AssetBundle;
    
    /**
 * Main backend application asset bundle.
 */
class LeafletTownAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    
    ];
    public $js = [
        'js/leaflet-town-page.js',
    ];
    public $depends = [
        'frontend\assets\LeafletAsset',
    ];
}
