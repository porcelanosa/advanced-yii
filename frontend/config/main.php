<?php
    $params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'),
        require(__DIR__ . '/params.php')
    );
    if ($_SERVER['HTTP_HOST'] == 'amtg.dev') {
        $params = array_merge(
            require(__DIR__ . '/../../common/config/params-local.php'),
            require(__DIR__ . '/params-local.php')
        );
    }
    return [
        'id'                  => 'app-frontend',
        'basePath'            => dirname(__DIR__),
        'bootstrap'           => ['log', 'porcelanosa\posts\Bootstrap'],
        'controllerNamespace' => 'frontend\controllers',
        'modules'             => [
            'user'  => [
                // following line will restrict access to admin controller from frontend application
                'as frontend' => 'dektrium\user\filters\FrontendFilter',
            ],
            'posts' => [
                'class'            => 'porcelanosa\posts\Module',
                'image_url'        => '/images/posts',
                'image_path_alias' => Yii::getAlias('@frontend') . '/web/images/posts',
            ],
        ],
        'components'          => [
            'request'      => [
                'baseUrl'   => '',
                'csrfParam' => '_csrf-frontend',
            ],
            /*'user' => [
                'identityClass' => 'common\models\User',
                'enableAutoLogin' => true,
                'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            ],
            
            'session' => [
                // this is the name of the session cookie used for login on the frontend
                'name' => 'advanced-frontend',
            ],*/
            'user'         => [
                'identityCookie' => [
                    'name'     => '_frontendIdentity',
                    'path'     => '/',
                    'httpOnly' => true,
                ],
            ],
            'session'      => [
                'name'         => 'FRONTENDSESSID',
                'cookieParams' => [
                    'httpOnly' => true,
                    'path'     => '/',
                ],
            ],
            'log'          => [
                'traceLevel' => YII_DEBUG ? 3 : 0,
                'targets'    => [
                    [
                        'class'  => 'yii\log\FileTarget',
                        'levels' => ['error', 'warning'],
                    ],
                ],
            ],
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
            
            'urlManager'   => require __DIR__ . '/_urlManager.php',
            
            /*
            'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => [
                ],
            ],*/
        ],
        'params'              => $params,
    ];
