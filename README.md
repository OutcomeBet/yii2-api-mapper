# yii-api-mapper

Описание
=============
Библиотека для простой конфигурации маппинга данных полученных через api в модели Yii2

Установка
===========
Добавить в composer.json в секцию require
"OutcomeBet/yii2-api-mapper": "dev-master"
Прописать модуль в конфиг приложения
'apiMapper' => [
            'class' => 'outcomebet\apimapper\Module',
            'transport' => [
                'url' => 'http://localhost/'
            ],
            'mappers' => [
               .
               .
               .
            ]
        ],

Примеры 
=========
Пример конфигурационного массива
```php
    'apiMapper' => [
        'transport' => [
            'url' => 'http://localhost/json-api'
        ],
        'mappers' => [
            'table' => [
                'adapter' => [
                    'class' => \outcomebet\apimapper\transport\adapters\JsonRpc2Adapter::class,
                    'method' => 'tables.get',
                ],
                'model' => Table::class,
                'handler' => TableHandler::class
            ],
            'tableList' => [
                'adapter' => [
                     'class' => \outcomebet\apimapper\transport\adapters\JsonRpc2Adapter::class,
                     'method' => 'tables.list',
                 ],
                 'model' => ArrayCollection::class,
                 'target' => Table::class
            ]
        ]
    ]
];

````