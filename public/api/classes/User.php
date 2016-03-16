<?php
/**
 * User class.
 * @author RR
 */

class User {

    /**
     * Database Instance
     * @var PDO object
     * @access private
     */
    private $db;

    /**
     * Constructor function.
     */
    public function __construct() {
        //load database instance to $db member variable
        $this->db = DB::getInstance();
    }

    public function getAllUsers() {
        return $this->db->select("users");
    }
    //committt
    public function insertUser($insert) {
        $result = $this->db->insert("users", $insert);
        return array("data" =>$result,"insertedId" =>$this->db->lastInsertId());
    }
///update
    public function updateUser($update) {
        $bind = array(
            ":user_id" => $update['user_id']
        );
        return $this->db->update("users", $update['info'], "user_id = :user_id", $bind);
    }
//dddddd


    public function deleteUser($delete) {
        $bind = array(
            ":user_id" => $delete['user_id']
        );
        $ret = $this->db->delete("users","user_id = :user_id", $bind);
        return $ret;
    }
    /**
     * Select user by email
     * @param string $email user email
     * @return a user array / boolean(false)
     */
    public function getUserByEmail($email) {
        $bind = array(
            ":email" => $email
        );
        $result = $this->db->select("users", "email = :email", $bind);
        return (!empty($result)?$result[0]:false);
    }

    /**
     * Select user by id
     * @param int $userid user id
     * @return array() / boolean(false)
     */
    public function getUserById($user_id) {
        $bind = array(
            ":user_id" => $user_id
        );

        $result = $this->db->select("users", "user_id = :user_id", $bind);

        return (!empty($result) ? $result[0] : false);
    }

    /**
     * Select user by profil id
     * @param int $profilid profil id
     * @return array() / boolean(false)
     */
    public function getUserByProfilId($profilid) {
        $bind = array(
            ":profil_id" => $profilid
        );
        $result = $this->db->select("users", "profil_id = :profil_id", $bind);
        return (!empty($result)?$result:false);
    }

    /**
     * Select count of login attempts
     * @param int $userid user id
     * @return int
     */
    public function getLoginAttempts($userid) {
        // Get timestamp of current time
        $now = time();

        // All login attempts are counted from the past 2 hours.
        $valid_attempts = $now - (2 * 60 * 60);

        $bind = array(
            ":user_id" => $userid,
            ":time" => $valid_attempts
        );
        $result = $this->db->select("login_attempts", "user_id = :user_id AND time > :time", $bind,"time");
        return count($result);

    }

    /**
     * Add a failed connexion attempt in DB
     * @param int $userid user id
     * @return Boolean
     */
    public function insertFailedAttempt($userid) {
        $insert = array(
            "user_id" => $userid,
            "time" => time()
        );
        $this->db->insert("login_attempts", $insert);
    }

    /**
     * login
     * @param int $userid user id
     * @return Boolean
     */
    public function login() {
        $token = array();
        $token['id'] = 1;
        return JWT::encode($token,'secret_server_key');
    }
}// END class
