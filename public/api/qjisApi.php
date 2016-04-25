<?php
/**
 * r2i api class
 **/

require_once 'autoLoader.php';
require 'api.php';

class qjisApi extends api {

    private $arrOfParams;

    // Constructor function
    function __construct() {
        parent::__construct();
        //init array of parameters
        $this->arrOfParams = array();
    }

    // process api method
    function processApi($action="") {
        switch($action) {
            case "login" : $this->get_login($_POST['user'],$_POST['mdp']);break;
            default : break;
        }
    }

    //requested methods here

    private function get_login($login,$mdp) {
        if($login=="ayoub")
            echo "1";
        else echo "0";
    }

}// END class

$api = new qjisApi();
if(isset($_POST['action']) && $_POST['action']!="") {
    $api->processApi($_POST['action']);
}

else echo json_encode(array('status'=>'error','msg'=>'erreur traitement serveur !'));
