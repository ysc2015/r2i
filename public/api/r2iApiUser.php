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
            if(is_array($_POST['parameters']) || is_object($_POST['parameters'])) {
                $parameters = $_POST['parameters']; // json_decode($_POST['parameters'],true);
            } else {
                $parameters = json_decode($_POST['parameters'],true);
            }
            array_push($this->arrOfParams,$parameters);
            call_user_func_array(array($this,$method),$this->arrOfParams);
        } else call_user_func(array($this,$method));
    }



    private function get_all_users() {
        $user= new User();
        $users = $user->getAllUsers();
        $this->sendResponse(200,json_encode(array('status'=>'success','data' => $users)));
    }


    private function insert_user($insert) {
        $user= new User();
        $result = $user->insertUser($insert);
        var_dump($result);
        if($result)

            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'INSERT OK', "idp" => $result['insertedId'])));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'INSERT ERROR')));
    }
    private function get_user_by_id($id_user) {
        $user = new User();
        $user = $user->getUserById($id_user['user_id']);
        if($user)
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'SELECT OK','user' => json_encode($user))));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'SELECT ERROR')));
    }


    private function update_user($update) {
        $user = new User();
        var_dump($update);
        $user = $user->updateUser($update);
        if($user)
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'UPDATE OK','user' => json_encode($user))));
        else
            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'UPDATE ERROR')));
    }


    private function delete_user($delete) {
        $user = new User();
        if($user->deleteUser($delete))
            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'DELETE OK')));
        else{

            $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'DELETE ERROR')));
        }
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
if(isset($_POST['method']) && $_POST['method'] != "") {
    sleep(1);//test loader
    $api->processApi($_POST['method']);
}

else echo json_encode(array('status'=>'error','msg'=>'erreur traitement serveur !'));
