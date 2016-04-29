<?php
/**
 * r2i api class
 **/

require_once 'autoLoader.php';
require 'api.php';

//Turning errors into exceptions (disable warning in browsers console to allow loggin errors into db)
set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

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
            if(is_array($_POST['parameters']) || is_object($_POST['parameters'])) {
                $parameters = $_POST['parameters']; // json_decode($_POST['parameters'],true);
            } else {
                $parameters = json_decode($_POST['parameters'],true);
            }
            array_push($this->arrOfParams,$parameters);
            call_user_func_array(array($this,$method),$this->arrOfParams);
        } else call_user_func(array($this,$method));
    }

    //requested methods here

    /**
     * Projects & Sub Projects methods
     */

    /**
     * get all projects
     * @return JSON
     */
    private function get_all_projects() {
        $this->sendResponse(200,json_encode(ProjectPDO::getAllProjects()));
    }

    /**
     * Select sub projects of given project (id)
     * @return JSON
     */
    private function get_sub_projects_by_project_id($param) {
        $this->sendResponse(200,json_encode(SubProjectPDO::getSubProjectsByProjectId($param['projectid'])));
    }

    /*private function get_projects_by_id($id_project) {
        $project = new Project();
        $project = $project->getProjectById($id_project['project_id']);
        if($project)
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'SELECT OK','project' => json_encode($project))));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'SELECT ERROR')));
    }*/
    /**
     * Insert a project
     * @return JSON
     */
    private function insert_project($insert) {
        $this->sendResponse(200,json_encode(ProjectPDO::insertProject($insert)));
    }

    private function update_project($update) {
        $this->sendResponse(200,json_encode(ProjectPDO::updateProject($update)));
    }

    private function update_sub_project($update) {
        $this->sendResponse(200,json_encode(SubProjectPDO::updateSubProject($update)));
    }

    /**
     * Update a user
     * @return JSON
     */
    private function update_user($update) {
        $this->sendResponse(200,json_encode(UserPDO::updateUser($update)));
    }

    private function get_all_rooms_files() {
        $roomsfile = new Room();
        $roomsfiles = $roomsfile->getAllRoomsFiles();
        $this->sendResponse(200,json_encode(array('status'=>'success','data'=>$roomsfiles)));
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
     * delete user
     * @return JSON
     */
    private function delete_user($delete) {
        $this->sendResponse(200,json_encode(UserPDO::deleteUser($delete)));
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
     * Select STT users
     * @return JSON
     */
    private function get_stt_users() {
        $user = new User();
        $users = $user->getUserByProfilId(2);
        $this->sendResponse(200,json_encode(array('status'=>'success','data'=>$users)));
    }

    /**
     * Insert user
     * @return JSON
     */
    private function insert_user($insert) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Create salted password
        $password = hash('sha512', $insert['p'] . $random_salt);
        $toinsert = array(
            "profil_id" => $insert['profil_id'],
            "user_firstname" => $insert['user_firstname'],
            "user_lastname" => $insert['user_lastname'],
            "email" => $insert['email'],
            "password" => $password,
            "salt" => $random_salt,
        );
        $this->sendResponse(200,json_encode(UserPDO::insertUser($toinsert)));
    }

    /**
     * Select ALL users
     * @return JSON
     */
    private function get_all_users() {
        $this->sendResponse(200,json_encode(UserPDO::getAllUsers()));
    }


    private function send_mail() {
        $mail = new MailNotifier();
        if($mail->sendMail())
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'MAIL OK')));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'MAIL ERROR')));
    }

    /**
     * Add a sub project
     * @return JSON
     */
    private function insert_sub_project($insert) {
        $this->sendResponse(200,json_encode(SubProjectPDO::insertSubProject($insert)));
    }

    /**
     * get project sd files
     * @return JSON
     */
    private function get_project_files($param) {
        $this->sendResponse(200,json_encode(ResourcePDO::getResourcesByObjectIdAndObjectType($param['project_id'],"project")));
    }

    /**
     * delete sd file
     * @return JSON
     */
    private function delete_resource_file($delete) {
        $this->sendResponse(200,json_encode(ResourcePDO::deleteResourceFile($delete)));
    }

    /**
     * validate project creation
     * @return JSON
     */
    private function validate_project_creation($param) {
        $this->sendResponse(200,json_encode(ProjectPDO::validateProjectCreation($param['project_id'])));
    }

    /**
     * Insert transport/switch entry
     * @return JSON
     */
    private function insert_transport_switch_entry($insert) {
        $this->sendResponse(200,json_encode(TransportSwitchEntryPDO::insertTransportSwitchEntry($insert)));
    }

    /**
     * Update transport/switch entry
     * @return JSON
     */
    private function update_transport_switch_entry($update) {
        $this->sendResponse(200,json_encode(TransportSwitchEntryPDO::updateTransportSwitchEntry($update)));
    }

    /**
     * Insert dist cdi entry
     * @return JSON
     */
    private function insert_distcdi_entry($insert) {
        $this->sendResponse(200,json_encode(DistCDIEntryPDO::insertDistCDIEntry($insert)));
    }

    /**
     * Update dist cdi entry
     * @return JSON
     */
    private function update_distcdi_entry($update) {
        $this->sendResponse(200,json_encode(DistCDIEntryPDO::updateDistCDIEntry($update)));
    }

    /**
     * Insert dist connect entry
     * @return JSON
     */
    private function insert_distconnect_entry($insert) {
        $this->sendResponse(200,json_encode(DistConnectEntryPDO::insertDistConnectEntry($insert)));
    }

    /**
     * Update dist connect entry
     * @return JSON
     */
    private function update_distconnect_entry($update) {
        $this->sendResponse(200,json_encode(DistConnectEntryPDO::updateDistConnectEntry($update)));
    }

    /**
     * Insert dist design entry
     * @return JSON
     */
    private function insert_distdesign_entry($insert) {
        $this->sendResponse(200,json_encode(DistDesignEntryPDO::insertDistDesignEntry($insert)));
    }

    /**
     * Update dist design entry
     * @return JSON
     */
    private function update_distdesign_entry($update) {
        $this->sendResponse(200,json_encode(DistDesignEntryPDO::updateDistDesignEntry($update)));
    }

    /**
     * Insert dist print entry
     * @return JSON
     */
    private function insert_distprint_entry($insert) {
        $this->sendResponse(200,json_encode(DistPrintEntryPDO::insertDistPrintEntry($insert)));
    }

    /**
     * Update dist print entry
     * @return JSON
     */
    private function update_distprint_entry($update) {
        $this->sendResponse(200,json_encode(DistPrintEntryPDO::updateDistPrintEntry($update)));
    }

    /**
     * Insert dist recipe entry
     * @return JSON
     */
    private function insert_distrecipe_entry($insert) {
        $this->sendResponse(200,json_encode(DistRecipeEntryPDO::insertDistRecipeEntry($insert)));
    }

    /**
     * Update dist recipe entry
     * @return JSON
     */
    private function update_distrecipe_entry($update) {
        $this->sendResponse(200,json_encode(DistRecipeEntryPDO::updateDistRecipeEntry($update)));
    }

    /**
     * Insert plates entry
     * @return JSON
     */
    private function insert_plates_entry($insert) {
        $this->sendResponse(200,json_encode(PlatesEntryPDO::insertPlatesEntry($insert)));
    }

    /**
     * Update plates entry
     * @return JSON
     */
    private function update_plates_entry($update) {
        $this->sendResponse(200,json_encode(PlatesEntryPDO::updatePlatesEntry($update)));
    }




}// END class

$api = new r2iApi();
if(isset($_POST['method']) && $_POST['method']!="") {
    $api->processApi($_POST['method']);
}

else echo json_encode(array('status'=>'error','msg'=>'erreur traitement serveur !'));
