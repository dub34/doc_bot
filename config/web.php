<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'TO0S-Jm3l_bK1wOfMpD-C4VJcQVNF2Pn',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'search' => [
            'class' => 'himiklab\yii2\search\Search',
            'models' => [
                \app\models\RemoteNode::class,
            ],
        ],
        'botParser' => [
            'class' => 'app\components\BotParser',
            'apiToken' => 'QW50b25fVmFybmF2c2tpeTpMYXNWZWdhczEyMw==',
        ],
        'mystem' => [
            'class' => 'Mystem\YiiMystem',
//      'falsePositive' => __DIR__ . '/mystem/false-positive.txt',
//      'falsePositiveNormalized' => __DIR__ . '/mystem/false-positive-normalized.txt',
//      'falseNegative' => __DIR__ . '/mystem/false-negative.txt',
//      'falseNegativeNormalized' => __DIR__ . '/mystem/false-negative-normalized.txt',
        ],
        'wordsExtractor' => [
            'class' => 'app\components\WordsExtractor',
            'stopwords' => require(__DIR__ . '/stopwords.php')
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'basePath'=>'@app/web/assets'
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'modules' => [
        'treemanager' => [
            'class' => '\kartik\tree\Module',
            'treeViewSettings' => [
                'nodeView' => '@app/views/node/_form'
            ]

        ]
    ],
    'params' => $params,
];

//if (YII_ENV_DEV) {
//    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
//        'allowedIPs' => ['*']
//    ];
//
//    $config['bootstrap'][] = 'gii';
//    $config['modules']['gii'] = [
//        'class' => 'yii\gii\Module',
//    ];
//}

return $config;
