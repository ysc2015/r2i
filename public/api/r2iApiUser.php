<?php
/**
 * r2i api class
 **/

require_once('lib/PHPExcel/PHPExcel/IOFactory.php');
require_once 'autoLoader.php';

require 'api.php';

class r2iApiUser extends api {

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

    /**
     * Projects methods
     */

    /**
     * Select all projects from DB
     * @return JSON
     */
    private function get_all_users() {
        $user= new User();
        $users = $user->getAllUsers();
        $this->sendResponse(200,json_encode(array('status'=>'success','data' => $users)));
    }

    /**
     * Insert a project
     * @return JSON
     */
    private function insert_user($insert) {
        $user= new User();
        $result = $user->insertUser($insert);
        if($result)
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'INSERT OK', "idp" => $result['insertedId'])));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'INSERT ERROR')));
    }

    /**
     * Update a project
     * @return JSON
     */
    private function update_user($update) {
        $user = new User();
        if($user->updateUser($update))
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'UPDATE OK')));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'UPDATE ERROR')));
    }

    /**
     * Delete a project
     * @return JSON
     */
    private function delete_user($delete) {
        $user = new User();
        if($user->deleteUser($delete))
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'DELETE OK')));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'DELETE ERROR')));
    }

    /**
     * Inject a project file
     * @return JSON
     */
    private function insert_file($insert) {
        $file = new File();
        if($file->insertFile($insert))
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'INSERT OK')));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'INSERT ERROR')));
    }

    /**
     * Rooms Files methods
     */

    /**
     * Select all Rooms Files from DB
     * @return JSON
     */
    private function get_all_rooms_files() {
        $roomsfile = new Room();
        $roomsfiles = $roomsfile->getAllRoomsFiles();
        $this->sendResponse(200,json_encode(array('status'=>'success','data'=>$roomsfiles)));
    }

    /**
     * Inject rooms file
     * @return JSON
     */
    private function inject_rooms_file() {
        $roomsfile = new Room();
        $result = $roomsfile->injectRoomsFile();
        $this->sendResponse(200,json_encode($result));
    }

    /**
     * Send mail
     * @return JSON
     */
    private function send_mail() {
        $mail = new MailNotifier();
        if($mail->sendMail())
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'MAIL OK')));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'MAIL ERROR')));
    }

}// END class

$api = new r2iApiUser();
if(isset($_POST['method']) && $_POST['method']!="") {
    sleep(1);//test loader
    $api->processApi($_POST['method']);
}

else echo json_encode(array('status'=>'error','msg'=>'erreur traitement serveur !'));
