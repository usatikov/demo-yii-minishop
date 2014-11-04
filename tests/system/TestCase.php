<?php

if (!class_exists('PHPUnit_Runner_Version')) {
    require_once('PHPUnit/Runner/Version.php');
    require_once('PHPUnit/Util/Filesystem.php'); // workaround for PHPUnit <= 3.6.11

    spl_autoload_unregister(array('YiiBase', 'autoload'));
    require_once('PHPUnit/Autoload.php');
    spl_autoload_register(array('YiiBase', 'autoload')); // put yii's autoloader at the end

    if (in_array('phpunit_autoload', spl_autoload_functions())) { // PHPUnit >= 3.7 'phpunit_autoload' was obsoleted
        spl_autoload_unregister('phpunit_autoload');
        Yii::registerAutoloader('phpunit_autoload');
    }
}

/**
 * Base class for all test case classes.
 *
 * Used instead of standard CDbTestCase to prevent errors with PHPUnit version > 4.0.
 * It is some kind of bug into YII CDbTestCase implementation.
 */
abstract class TestCase extends PHPUnit_Framework_TestCase
{

}
