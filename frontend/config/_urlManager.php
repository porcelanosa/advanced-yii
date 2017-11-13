<?php
    /**
     * Created by PhpStorm.
     * User: User
     * Date: 12.11.2017
     * Time: 14:56
     */
    /* 'urlManager'   => [
     'enablePrettyUrl' => true,
     'showScriptName'  => false,
     'scriptUrl'       => '/index.php',
   /*'rules' => [
         'posts/<post_type_slug>/<cat_slug>/<slug>' => 'posts/default/view',
         'posts/<post_type_slug>/<cat_slug>'        => 'posts/default/catview',
         'posts/<post_type_slug>'                   => 'posts/default/index',
     
],]*/
    
    	return [
            'class'           => yii\web\UrlManager::class,
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
        
            'rules' => [
                // Towns
                [
                    'pattern' => 'towns/<slug>',
                    'route' => 'towns/view'
                ],
            
                // Cats
                [
                    'pattern' => 'cats/<slug>',
                    'route' => 'cats/view'
                ],
            
                // Places
                'places/getgeo' => 'places/getgeo',
                [
                    'pattern' => 'places/<slug>',
                    'route' => 'places/view'
                ],
            
                // Articles
               /* [ 'pattern' => 'article/index', 'route' => 'article/index' ],
                [ 'pattern' => 'article/attachment-download', 'route' => 'article/attachment-download' ],
                [ 'pattern' => 'article/<slug>', 'route' => 'article/view' ],
            
                // Api
                [ 'class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/article', 'only' => [ 'index', 'view', 'options' ] ],
                [ 'class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/user', 'only' => [ 'index', 'view', 'options' ] ],*/
        
            ]
        ];