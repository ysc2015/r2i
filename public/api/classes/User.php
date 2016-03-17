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

    /**
     * Select all users from DB
     * @return array
     */
    public function getAllUsers() {
        return $this->db->select("users");
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
    public function getUserById($userid) {
        $bind = array(
            ":user_id" => $userid
        );
        $result = $this->db->select("users", "user_id = :user_id", $bind);
        return (!empty($result)?$result[0]:false);
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
     * @param array $param email/password:p
     * @return array
     */
    public function login($param) {
        $result = $this->getUserByEmail($param['email']);
        if($result !== false) {
            //user exists in database with $param['email']
            // hash the password with the unique salt.
            $password = hash('sha512', $param['p'] . $result['salt']);

            // Check if the password in the database matches
            // the password the user submitted.
            if ($result['password'] == $password) {
                //successfull connection
                $token = array();
                $token['id'] = $result['user_id'];
                //TODO make a define for server secret key later on
                return array('connected' => true,'msg' => 'connexion réussie','token' => JWT::encode($token,'secret_server_key'), 'ui' => $result['user_id']);

            } else {
                //incorrect password
                return array('connected' => false,'msg' => 'login ou mot de passe incorrect','token' => '');
            }

        } else {
            //user do not exists in database
            return array('connected' => false,'msg' => 'login ou mot de passe incorrect','token' => '');
        }

        return array();
    }
}// END class