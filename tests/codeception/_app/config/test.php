<?php
/**
 * @project yii2-api-mapper
 * @author Deller <deller@inbox.ru>
 */

return [
    'id' => 'yii2-api-mapper',
    'basePath' => dirname(__DIR__),
    'language' => 'en-US',
    'aliases' => [
        '@tests' => dirname(dirname(__DIR__)),
        '@vendor' => VENDOR_DIR,
        '@bower' => VENDOR_DIR . '/bower-asset',
    ],
    'modules' => [
        'apiMapper' => [
            'class' => 'outcomebet\apimapper\Module',
            'transport' => [
                'url' => 'http://localhost/'
            ],
            'mappers' => [
                'test' => [
                    'adapter' => [
                        'class' => \outcomebet\apimapper\transport\adapters\JsonRpc2Adapter::class,
                        'method' => 'tables.get',
                    ],
                    'model' => \outcomebet\apimapper\tests\codeception\models\TestModel::class,
                ]
            ]
        ],
    ],
    'components' => [
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],
    ],
    'params' => [],
];
