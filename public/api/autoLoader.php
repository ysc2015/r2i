<?php
/**
 * classes SPL autoloader.
 * PHP Version 5
 */

/**
 * SPL classes autoloader.
 * @param string $classname The name of the class to load
 */
function autoload($classname)
{
    if ((strpos($classname, 'PHPExcel') !== 0))
        require 'classes/'.ucfirst($classname).'.php';
}

if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
    //SPL autoloading was introduced in PHP 5.1.2
    if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
        spl_autoload_register('autoload', true, true);
    } else {
        spl_autoload_register('autoload');
    }
} else {
    /**
     * Fall back to traditional autoload for old PHP versions
     * @param string $classname The name of the class to load
     */
    function __autoload($classname)
    {
        autoload($classname);
    }
}
