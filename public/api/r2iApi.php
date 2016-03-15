<?php
/**
 * r2i api class
 **/

require_once('lib/PHPExcel/PHPExcel/IOFactory.php');
require_once('lib/JWT/JWT.php');
require_once 'autoLoader.php';

require 'api.php';

class r2iApi extends api {

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
    private function get_all_projects() {
        $project = new Project();
        $projects = $project->getAllProjects();
        $this->sendResponse(200,json_encode(array('status'=>'success','data'=>$projects)));
    }

    /**
     * Insert a project
     * @return JSON
     */
    private function insert_project($insert) {
        $project = new Project();
        $result = $project->insertProject($insert);
        if($result)
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'INSERT OK', "idp" => $result['insertedId'])));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'INSERT ERROR')));
    }

    /**
     * Update a project
     * @return JSON
     */
    private function update_project($update) {
        $project = new Project();
        if($project->updateProject($update))
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'UPDATE OK')));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'UPDATE ERROR')));
    }

    /**
     * Delete a project
     * @return JSON
     */
    private function delete_project($delete) {
        $project = new Project();
        if($project->deleteProject($delete))
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
    private function get_all_rooms() {
        $room = new Room();
        $rooms = $room->getAllRooms();
        $this->sendResponse(200,json_encode(array('status'=>'success','data'=>$rooms)));
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
     * Users methods
     */

    /**
     * Select STT users from DB
     * @return JSON
     */
    private function get_stt_users() {
        $user = new User();
        $users = $user->getUserByProfilId(2);
        $this->sendResponse(200,json_encode(array('status'=>'success','data'=>$users)));
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

$api = new r2iApi();
if(isset($_POST['method']) && $_POST['method']!="") {
    $api->processApi($_POST['method']);
}

else echo json_encode(array('status'=>'error','msg'=>'erreur traitement serveur !'));
