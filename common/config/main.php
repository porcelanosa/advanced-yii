<?php
    return [
        'vendorPath'     => dirname(dirname(__DIR__)) . '/vendor',
        
        // set target language to be Russian
        'language'       => 'ru-RU',
        // set source language to be English
        'sourceLanguage' => 'en-US',
        //'bootstrap'           => ['posts'],
        'components'     => [
            'db'    => [
                'class'    => 'yii\db\Connection',
                'dsn'      => getenv('DB_DSN'),
                'username' => getenv('DB_USERNAME'),
                'password' => getenv('DB_PASSWORD'),
                'charset'  => 'utf8',
            ],
            'cache' => [
                'class' => 'yii\caching\FileCache',
            ],
            'request' => [
                // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
                'cookieValidationKey' => getenv('COOKIE_VALIDATION_KEY'),
            ],
        ],
        'modules'        => [
            'user' => [
                'class'                  => 'dektrium\user\Module',
                // you will configure your module inside this file
                // or if need different configuration for frontend and backend you may
                // configure in needed configs
                'enableUnconfirmedLogin' => true,
                'confirmWithin'          => 21600,
                'cost'                   => 12,
                'admins'                 => ['admin']
            ],
            /*'posts' => [
                'class' => 'porcelanosa\posts\Module',
                'image_url' => '/images/posts',
                'image_path_alias' => Yii::getAlias('@frontend').'/web/images/posts',
            ],*/
        ],
    ];
