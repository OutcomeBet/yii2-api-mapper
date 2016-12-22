<?php
/**
 * @project yii2-api-mapper
 * @author Deller <deller@inbox.ru>
 */

return [
    'apiMapper' => [
        'transport' => [
            'url' => 'http://thimbles.loc/json-api'
        ],
        'mappers' => [
            'tableList' => [
                'adapter' => [
                    'class' => \outcomebet\apimapper\transport\adapters\JsonRpc2Adapter::class,
                    'method' => 'tables.list',
                ],
                'model' => ''
            ]
        ]
    ]
];
