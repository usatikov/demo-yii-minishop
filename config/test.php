<?php
/**
 * This is the configuration for unit-tests. Extends main config and testing parameters.
 */
return CMap::mergeArray(
    require(__DIR__ . '/main.php'),
    [
        'import' => [
            'application.tests.system.*',
        ],

        'components' => [
            'fixture' => [
                'class' => 'system.test.CDbFixtureManager',
            ],

            // Normally you should create separate DB to run unit-tests.
            // But to simplify the process, we create test_product table specially for tests
            'db' => [
                'tablePrefix' => 'test_',
            ],
        ],
    ],
    file_exists(__DIR__ . '/test.local.php') ? require(__DIR__ . '/test.local.php') : []
);
