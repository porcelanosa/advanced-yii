<?php
    
    use Dotenv\Dotenv;
    
    require(__DIR__ . '/../../vendor/autoload.php');
    /**
     * Load application environment from .env file
     */
    $dotenv = new Dotenv(dirname(__DIR__) . '/../');
    $dotenv->load();
    /**
     * Init application constants
     */
    defined('YII_DEBUG') or define('YII_DEBUG', getenv('YII_DEBUG') === 'true');
    defined('YII_ENV') or define('YII_ENV', getenv('YII_ENV') ? : 'prod');
    
    require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
    require(__DIR__ . '/../../common/config/bootstrap.php');
    require(__DIR__ . '/../config/bootstrap.php');
    require(__DIR__ . '/../config/bootstrap.php');
    
    
    if ($_SERVER['HTTP_HOST'] == 'amtg.dev') {
        $commonMainLocal = require(__DIR__ . '/../../common/config/main-local.php');
        $MainLocal       = require(__DIR__ . '/../config/main-local.php');
    } else {
        $commonMainLocal = [];
        $MainLocal       = [];
    }
    $config = yii\helpers\ArrayHelper::merge(
        require(__DIR__ . '/../../common/config/main.php'),
        $commonMainLocal,
        require(__DIR__ . '/../config/main.php'),
        $MainLocal
    );
    
    (new yii\web\Application($config))->run();
