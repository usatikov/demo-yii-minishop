<?php
/**
 * Example of local config. Here you can extend default config and make all necessary changes.
 */
return [
    // Name of the shop. Will be displayed on every page
    'name' => 'Cosy Paintings Shop',

    'components' => [
        'db' => [
            'connectionString' => 'mysql:host=localhost;dbname={DBNAME}',
            'username' => '{USERNAME}',
            'password' => '{PASSWORD}',
        ],

        'cache' => [
            'class' => 'CMemCache',
            'useMemcached' => true,
            'servers' => [[
                'host' => '127.0.0.1',
                'port' => 11211,
            ]],
        ],
    ],

    'params' => [
        // How many products should be loaded by one request
        'pageSize' => 10,

        // Product's cache lifetime (in seconds)
        'cacheDuration' => 10,
    ],
];
