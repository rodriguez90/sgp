<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
//    'bootstrap' => ['log', 'history'],
    'bootstrap' => ['log',],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'es',
    'name'=>'SGP',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dsdsdsadsadasd',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'Da\User\Model\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/user/security/login']
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => '127.0.0.1',
                'port' => '25',
//				'host' => '',
//                'username' => '',
//                'password' => '',
//                'port' => '587',
//                'encryption' => 'tls',
            ],
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
            'rules' => [
            ],
        ],
        'authManager' => [
//            'class' => 'yii\rbac\DbManager',
            'class' => 'Da\User\Component\AuthDbManagerComponent',
//            'class' => 'justcoded\yii2\rbac\components\DbManager',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d-m-Y',
            'datetimeFormat' => 'php:d-m-Y H:i',
            'timeFormat' => 'php:H:i:s',
            'thousandSeparator'=>'.',
            'decimalSeparator'=>',',
            'currencyCode'=>'USD'
        ],
        'as AccessBehavior' => [
            'class' => '\app\components\AccessBehavior'
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@Da/User/resources/views' => '@app/views/user'
                ]
            ]
        ]
    ],
    'modules' => [
       'user' => [
           'class' => Da\User\Module::class,
           'viewPath' => '@Da/User/resources/views',
           'classMap' => [
               'RegistrationForm' => 'app\forms\RegistrationForm',
           ],
           'controllerMap' => [
               'registration' => 'app\controllers\RegistrationController'
           ],
           'administrators'=>['root'],
           'administratorPermissionName'=>'Administrador',
           'enableRegistration'=>true,
           'enableEmailConfirmation'=>false,
           'enableFlashMessages'=>false,
           'allowUnconfirmedEmailLogin'=>true,
           'allowAccountDelete'=>false,
           'generatePasswords'=>false,
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
//        // uncomment the following to add your IP if you are not connecting from localhost.
//        //'allowedIPs' => ['127.0.0.1', '::1'],
//    ];

//    $config['bootstrap'][] = 'gii';
//    $config['modules']['gii'] = [
//        'class' => 'yii\gii\Module',
//        // uncomment the following to add your IP if you are not connecting from localhost.
//        //'allowedIPs' => ['127.0.0.1', '::1'],
//    ];

    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],
        'generators' => [ //here
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'adminlte' => '@vendor/dmstr/yii2-adminlte-asset/gii/templates/crud/simple',
                ]
            ]
        ],
    ];
}

return $config;
