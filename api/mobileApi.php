<?php
/**
 * mobile api class
 **/

require_once 'autoLoader.php';

require 'api.php';

class mobileApi extends api {

    private $arrOfParams;

    // Constructor function
    function __construct() {
        parent::__construct();
        //init array of parameters
        $this->arrOfParams = array();
    }

    // process api method
    function processApi($method="") {

        if(isset($_POST['parameters'])) {
            $parameters = json_decode($_POST['parameters'],true);
            array_push($this->arrOfParams,$parameters);
            call_user_func_array(array($this,$method),$this->arrOfParams);
        } else call_user_func(array($this,$method));
    }

    //requested methods here

    //get Job Orders
    function get_job_orders() {
        $job = new JobOrder();
        $jobs = $job->getUpdate();
        $this->sendResponse(200,$jobs);
    }

    /**
     * Reset update flag for job_orders
     * @return JSON
     */
    private function reset_flag_job_orders($list) {
        $job = new JobOrder();
        if($job->resetUpdateFlagFromList($list))
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'RESET OK')));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'RESET ERROR')));
    }

    /**
     * check for updates
     * @return JSON|bool
     */
    private function check_update() {
        $room = new JobRoom();
        $rooms = $room->getRoomsToSynchronize();
        echo $rooms;
    }

}// END class

$api = new mobileApi();
if(isset($_POST['method']) && $_POST['method']!="") {
    sleep(1);//test loader
    $api->processApi($_POST['method']);
}

else echo json_encode(array('status'=>'error','msg'=>'erreur traitement serveur !'));