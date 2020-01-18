<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$aliases = require __DIR__ . '/aliases.php';
$modules = require __DIR__ . '/modules.php';
$mailer = require(__DIR__ . '/mailer.php');

$config = [
    'id' => 'design',
    'name' => 'ЧудоНовости.рф',
    'language' => 'ru_RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => $aliases,
    'components' => [
//        'assetManager' => [
//            'bundles' => [
//                'all' => [
//                    'class' => 'yii\web\AssetBundle',
//                    'basePath' => '@webroot/assets',
//                    'baseUrl' => '@web/assets',
//                    'css' => ['css/site.css'],
//                    'js' => ['js/app.js'],
//                ],
//            ],
//        ],
//        'assetManager' => [
//            'bundles' => [
//                'yii\web\JqueryAsset' => [
//                    'sourcePath' => null,
//                    'basePath' => '@webroot',
//                    'baseUrl' => '@web',
//                    'js' => [ '/js/1.8.3/jquery.min.js' ]
//                ],
//            ],
//        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => env('COOKIE_VALIDATION_KEY'),
        ],
//        'authManager' => [
//            'class' => 'yii\rbac\DbManager',
//        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl'=>['/office/sign-in/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'mailer' => $mailer,
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'collapseSlashes' => true,
                'normalizeTrailingSlash' => true
            ],
        ],
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/design',
                'baseUrl' => '@web/themes/design',
                'pathMap' => [
                    '@app/views' => '@app/themes/design/views',
                    '@app/modules' => '@app/themes/design/modules',
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app'       => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ]
    ],
    'modules' => $modules,
    'params' => $params,
];

if (env('YII_DEBUG')) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['172.18.0.*', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['172.18.0.*', '::1'],
        'generators' => [ //here
            'crud' => [ // generator name
                'class' => yii\gii\generators\crud\Generator::class, // generator class
                'templates' => [ //setting for out templates
                    'bootstrap-tabs-crud' => '@app/gii/crud/bootstrap-tabs-crud', // template name => path to template
                ]
            ]
        ]
    ];
}

return $config;
