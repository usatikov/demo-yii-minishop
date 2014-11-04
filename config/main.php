<?php
/**
 * This is the main Web application configuration
 */
return CMap::mergeArray(
    [
        'basePath' => dirname(__DIR__),
        'name' => 'Mini-Shop',

        // autoloading model and component classes
        'import' => [
            'application.models.*',
            'application.components.*',
        ],

        // application components
        'components' => [
            'user' => [
                'class' => 'WebUser',
                'allowAutoLogin' => true,
                'loginUrl' => ['admin/login'],
            ],
            'db' => [
                'connectionString' => 'mysql:host=localhost;dbname={DBNAME}',
                'emulatePrepare' => true,
                'username' => '{USERNAME}',
                'password' => '{PASSWORD}',
                'charset' => 'utf8',
                'tablePrefix' => '',
            ],
            'errorHandler' => [
                // use 'site/error' action to display errors
                'errorAction' => 'site/error',
            ],
            'request' => [
                // Protect forms against CSRF
                'enableCsrfValidation' => true,
            ],
            'images' => [
                'class' => 'ImageManager',
            ],
            'cache' => [
                'class' => 'CDummyCache',
            ],
        ],

        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params' => [
            // How many products should be loaded by one request
            'pageSize' => 10,

            // Product's cache lifetime (in seconds)
            'cacheDuration' => 60,
        ],
    ],
    file_exists(__DIR__ . '/main.local.php') ? require(__DIR__ . '/main.local.php') : []
);
