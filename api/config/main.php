<?php

$db = require(__DIR__ . '/../../config/db.php');
$params = array_merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);


$config = [
    'id' => 'basic',
    'name' => 'DocLandApi',
    // Need to get one level up:
    'basePath' => dirname(__DIR__) . '/..',
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // Enable JSON Input:
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                /** @var \yii\web\Response $response */
                $response = $event->sender;
                if (!$response->isSuccessful && is_array($response->data)) {
                    if (isset($response->data['status'])) {
                        $response->data = [
                            'result' => $response->data['status'],
                            'resultMessage' => $response->data['message'],
                        ];
                    } // Data Validation Failed.
                    else {
                        if ($response->getStatusCode() == 422) {
                            $response->data = [
                                'result' => $response->getStatusCode(),
                                'resultMessage' => $response->statusText,
                                'data' => $response->data
                            ];
                        } else {
                            $response->data = [
                                'result' => $response->getStatusCode(),
                                'resultMessage' => $response->statusText,
                                'data' => null
                            ];
                        }
                    }
                }
            },
        ],
        'wordsExtractor' => [
            'class' => 'app\components\WordsExtractor',
            'stopwords' => require(__DIR__ . '/stopwords.php')
        ],
        'search' => [
            'class' => 'himiklab\yii2\search\Search',
            'models' => [
                \app\models\RemoteNode::class,
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    // Create API log in the standard log dir
                    // But in file 'api.log':
                    'logFile' => '@app/runtime/logs/api.log',
                ],
            ],
        ],
        'botParser' => [
            'class' => 'app\components\BotParser',
            'apiToken' => 'QW50b25fVmFybmF2c2tpeTpMYXNWZWdhczEyMw==',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'v1/block',
                    ],
                    'extraPatterns' => [
                        'GET indexing' => 'indexing',
                    ],
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'db' => $db,
    ],
    'modules' => [
        'v1' => [
            'class' => 'app\api\modules\v1\Module',
        ],
    ],
    'params' => $params,
];

return $config;