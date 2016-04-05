<?php
/**
 * r2i api class
 **/

require_once('lib/PHPExcel/PHPExcel/IOFactory.php');
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
     * Select all projects from DB
     * @return JSON
     */
    private function get_all_projects() {
        $project = new Project();
        $projects = $project->getAllProjects();
        $this->sendResponse(200,json_encode(array('status'=>'success','data'=>$projects)));
    }

    /**
     * Select sub projects of given project (id)
     * @return JSON
     */
    private function get_sub_projects_by_project_id($param) {
        /*$subproj = new SubProject();
        $subprojects = $subproj->getSubProjectsByProjectId($param['projectid']);*/
        $this->sendResponse(200,json_encode(array('status'=>'success','data'=>SubProjectPDO::getSubProjectsByProjectId($param['projectid']))));
    }

    private function get_projects_by_id($id_project) {
        $project = new Project();
        $project = $project->getProjectsbyid($id_project['project_id']);
        if($project)
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'SELECT OK','project' => json_encode($project))));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'SELECT ERROR')));
    }
    /**
     * Insert a project
     * @return JSON
     */
    private function insert_project($insert) {
        $project = new Project();
        $this->sendResponse(200,json_encode($project->insertProject($insert)));
    }

    private function update_project($update) {
        $project = new Project();
        $project = $project->updateProject($update);
        if($project)
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'UPDATE OK','project' => json_encode($project))));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'UPDATE ERROR')));
    }

    /**
     * Update a user
     * @return JSON
     */
    private function update_user($update) {
        $user = new User();
        $result = $user->updateUser($update);
        if($result) {
            $this->sendResponse(200,json_encode(array('done'=>true,'msg'=>'Utilsateur modifié !')));
        } else {
            $this->sendResponse(200,json_encode(array('done'=>false,'msg'=>'Utilsateur modifié !')));//Probléme modification utilisateur !
        }//TODO check why same object modified return false
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
        $user = new User();
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Create salted password
        $password = hash('sha512', $insert['p'] . $random_salt);
        $insert2 = array(
            "profil_id" => $insert['profil_id'],
            "user_firstname" => $insert['user_firstname'],
            "user_lastname" => $insert['user_lastname'],
            "email" => $insert['email'],
            "password" => $password,
            "salt" => $random_salt,
        );
        $result = $user->insertUser($insert2);
        if($result) {
            $this->sendResponse(200,json_encode(array('done'=>true,'msg'=>'Utilsateur crée !')));
        } else {
            $this->sendResponse(200,json_encode(array('done'=>false,'msg'=>'Probléme création utilisateur !')));
        }
    }

    /**
     * Select ALL users
     * @return JSON
     */
    private function get_all_users() {
        $user= new User();
        $users = $user->getAllUsers();
        $this->sendResponse(200,json_encode(array('status'=>'success','data' => $users)));
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

}// END class

$api = new r2iApi();
if(isset($_POST['method']) && $_POST['method']!="") {
    $api->processApi($_POST['method']);
}

else echo json_encode(array('status'=>'error','msg'=>'erreur traitement serveur !'));
