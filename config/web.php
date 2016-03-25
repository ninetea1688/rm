<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
     'name'=>'ระบบบริหารความเสี่ยง',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
  
       
        /////admin theme
        'view' => [
         'theme' => [
             'pathMap' => [
                '@app/views' => '@app/themes/adminlte'
             ],
         ],
    ],
         /////admin theme End
        
        
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'rm47cuaeuXkPjBljPxHAVA3G3CUCBwoP',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            //'identityClass' => 'app\models\User',
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
                'viewPath' => '@app/mail',
                'useFileTransport' => false,
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'smtp.gmail.com',
                    'username' => 'bomkeendata@gmail.com',
                    'password' => '666loveloev',
                    'port' => '587',
                    'encryption' => 'tls',
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
    'user' => [
        'class' => 'dektrium\user\Module',
        'enableUnconfirmedLogin' => true,
        'enableConfirmation'=>false,
        'confirmWithin' => 21600,
        'cost' => 12,
        'admins' => ['admin']
    ],
        'gridview' =>  [
        'class' => '\kartik\grid\Module'
       
    ],
    //...
],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
