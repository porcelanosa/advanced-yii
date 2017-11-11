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
    
    $config = [
        'id'                  => 'app-backend',
        'basePath'            => dirname(__DIR__),
        'controllerNamespace' => 'backend\controllers',
        'bootstrap'           => ['log'],
        
        'controllerMap' => [
            'elfinder' => [
                'class'            => 'mihaildev\elfinder\Controller',
                'access'           => ['@'],
                //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
                'disabledCommands' => ['netmount'],
                //отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#commands
                'roots'            => [
                    [
                        'baseUrl'  => '/images',
                        'basePath' => Yii::getAlias('@frontend') . '/web/images',
                        //'path' => Yii::getAlias('@userfiles'),
                        'name'     => 'Все файлы'
                    ]
                    /*,
                    [
                        'class' => 'mihaildev\elfinder\volume\UserPath',
                        'path'  => 'files/user_{id}',
                        'name'  => 'My Documents'
                    ],
                    [
                        'path' => 'files/some',
                        'name' => ['category' => 'my','message' => 'Some Name'] //перевод Yii::t($category, $message)
                    ],
                    [
                        'path'   => 'files/some',
                        'name'   => ['category' => 'my','message' => 'Some Name'], // Yii::t($category, $message)
                        'access' => ['read' => '*', 'write' => 'UserFilesAccess'] // * - для всех, иначе проверка доступа в даааном примере все могут видет а редактировать могут пользователи только с правами UserFilesAccess
                    ]*/
                
                ],
            ]
        ],
        'modules'       => [
            'user'  => [
                // following line will restrict access to profile, recovery, registration and settings controllers from backend
                'as backend' => 'dektrium\user\filters\BackendFilter',
            ],
            'rbac'  => 'dektrium\rbac\RbacWebModule',
            'posts' => [
                'class'            => 'porcelanosa\posts\Module',
                'image_url'        => '/images/posts',
                'image_path_alias' => Yii::getAlias('@frontend') . '/web/images/posts',
                'controllerMap'    => [
                    'postadmin' => [
                        'class'     => 'porcelanosa\posts\controllers\AdminController',
                        'as access' => [
                            'class' => \yii\filters\AccessControl::className(),
                            'rules' => [
                                [
                                    'allow' => true,
                                    'roles' => ['administrator'],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        
        ],
        'components'    => [
            'request'      => [
                'baseUrl'   => '/admin',
                'csrfParam' => '_csrf-backend',
            ],
            /*'user' => [
                'identityClass' => 'common\models\User',
                'enableAutoLogin' => true,
                'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            ],
            'session' => [
                // this is the name of the session cookie used for login on the backend
                'name' => 'advanced-backend',
            ],*/
            'user'         => [
                'identityCookie' => [
                    'name'     => '_backendIdentity',
                    'path'     => '/admin',
                    'httpOnly' => true,
                ],
            ],
            'session'      => [
                'name'         => 'BACKENDSESSID',
                'cookieParams' => [
                    'httpOnly' => true,
                    'path'     => '/admin',
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
            'urlManager'   => [
                'scriptUrl'       => '/admin/index.php',
                'enablePrettyUrl' => true,
                'showScriptName'  => false,
                'rules'           => [
                ],
            ],
            /*
            'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => [
                ],
            ],
            */
            /*'view' => [
                'theme' => [
                    'pathMap' => [
                        '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                    ],
                ],
            ],*/
            'assetManager' => [
                'bundles' => [
                    'dmstr\web\AdminLteAsset' => [
                        'skin' => 'skin-black-light', // тема для AdminLTE
                    ],
                ],
            ],
        ],
        'params'        => $params,
    ];
    
    if (YII_ENV_DEV) {
        $config['modules']['gii'] = [
            'class'      => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],
            'generators' => [ //here
                'crud' => [
                    'class'     => 'yii\gii\generators\crud\Generator',
                    'templates' => [
                        'adminlte' => '@vendor/dmstr/yii2-adminlte-asset/gii/templates/crud/simple',
                    ]
                ]
            ],
        ];
    }
    return $config;