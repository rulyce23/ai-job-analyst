<?php

return [
    'checks' => [
        'database' => [
            'class' => \Spatie\Health\Checks\Checks\DatabaseCheck::class,
        ],
        'cache' => [
            'class' => \Spatie\Health\Checks\Checks\CacheCheck::class,
        ],
        'environment' => [
            'class' => \Spatie\Health\Checks\Checks\EnvironmentCheck::class,
        ],
    ],

    'route' => [
        'enabled' => true,
        'path' => 'health',
    ],
];
