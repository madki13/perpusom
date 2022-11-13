<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Perpustakaan SMK',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'admin'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/themes/stisla',
                    '@dektrium/user/views' => '@app/themes/stisla/user',
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
            'defaultRoles' => ['guest'], //nama role user tanpa login
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'WTo8Q3XRlfWSjo-KvK2dZCIB1eFjzs6',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
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
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            '*',
        ]
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['applicanity', 'admin'], //['admin'] harus sesuai dengan username
            'modelMap' => [
                'User' => [
                    'class' => 'app\models\User',
                ],
                'Profile' => [
                    'class' => 'app\models\Profile',
                ],
            ],
            'controllerMap' => [
                'login' => [
                    'class' => \dektrium\user\controllers\SecurityController::className(),
                    'on ' . \dektrium\user\controllers\SecurityController::EVENT_AFTER_LOGIN => function ($e) {
                        \Yii::$app->response->redirect('site');
                    },
                ],
                'security' => 'app\modules\user\controllers\SecurityController',
                'settings' => 'app\modules\user\controllers\SettingsController',
                'recovery' => 'app\modules\user\controllers\RecoveryController',
                'registration' => 'app\modules\user\controllers\RegistrationController',
                'confirm' => 'app\modules\user\controllers\ConfirmController',
            ],
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => '@app/themes/stisla/layouts/main',
        ],
        'gridview' => ['class' => '\kartik\grid\Module']
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'generators' => [
            'applicanityStandardCrud' => [
                'class' => 'app\components\gii\ApplicanityStandard\Generator',
                'templates' => [
                    'applicanityStandardCrud' => '@app/components/gii/ApplicanityStandard/default',
                ]
            ]
        ],
    ];
}

return $config;
