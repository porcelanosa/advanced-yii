<?php
    Yii::setAlias('@common', dirname(__DIR__));
    Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
    Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
    Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
    
    const DS = DIRECTORY_SEPARATOR;
    /*Yii::setAlias('@upload', dirname(dirname(__DIR__)) . '/frontend/web/userfiles/upload/image/');
    Yii::setAlias('@uploadUrl', '/userfiles/upload/image/');
    Yii::setAlias('@userfiles', realpath(dirname(dirname(__DIR__)) . '/frontend/web/userfiles'));
    Yii::setAlias('@userfilesUrl', '/userfiles/');*/