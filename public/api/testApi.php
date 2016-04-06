<?php
/**
 * test api class
 **/

require 'autoLoader.php';
require 'api.php';

class testApi extends api {

    // Constructor function
    function __construct() {
        parent::__construct();
    }

    // process api method
    function processApi($method="") {
        print_r(ProjectPDO::getProjectbyid(3));
    }
}// END class

$api = new testApi();
$api->processApi();
