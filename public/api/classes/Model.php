<?php
/**
 * abstract Model class.
 * @author RR
 */

require_once 'autoLoader.php';

abstract class Model {

    /**
     * Constructor function.
     */
    function __construct() {

        //Turning errors into exceptions (disable warning in browsers console to allow loggin errors into db)
        set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
            // error was suppressed with the @-operator
            if (0 === error_reporting()) {
                return false;
            }

            throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
    }

    /**
     * Log errors
     * @return void
     */
    protected function logIt($message) {
        $ret = array("Log" => $message);
        var_dump($ret);
    }

}// END class
