<?php
    /**
     * Created by PhpStorm.
     * User: User
     * Date: 11.11.2017
     * Time: 20:52
     */
    namespace backend\assets;
    use yii\web\AssetBundle;
    
        class AdminLtePluginAsset extends AssetBundle
    {
        public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
        public $js = [
            'iCheck/icheck.min.js',
            // more plugin Js here
        ];
        public $css = [
            'iCheck/square/green.css',
            // more plugin CSS here
        ];
        public $depends = [
            'dmstr\web\AdminLteAsset',
        ];
    }