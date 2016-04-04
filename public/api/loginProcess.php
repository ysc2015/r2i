<?php
/**
 * login process api class.
 * @author RR
 */

require_once 'autoLoader.php';

class loginProcess {

    /**
     * Constructor function.
     */
    function __construct() {
        //init session
        $session = new Session();
        $session->sec_session_start();
    }

    /**
     * Check user credentiels
     * @param string $email user email
     * @param string(hashed) $password user password
     * @return JSON response
     */
    function login($email, $password) {
        $user = new User();
        $result = $user->getUserByEmail($email);

        if($result) {
            //user exists in database with $email
            // hash the password with the unique salt.
            $password = hash('sha512', $password . $result['salt']);

            // If the user exists we check if the account is locked
            // from too many login attempts
            if($this->checkbrute($result['user_id'])) {
                // Account is locked
                return json_encode(array('status'=>'error','msg'=>'votre compte est bloqué !'));
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($result['password'] == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];

                    // XSS protection as we might print values below
                    $user_id = preg_replace("/[^0-9]+/", "", $result['user_id']);
                    $_SESSION['user_id'] = $user_id;

                    $profil_id = preg_replace("/[^0-9]+/", "", $result['profil_id']);
                    $_SESSION['profil_id'] = $profil_id;

                    $user_firstname = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $result['user_firstname']);
                    $user_lastname = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $result['user_lastname']);
                    $_SESSION['username'] = $user_firstname." ".$user_lastname;

                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);

                    // Login successful.
                    return json_encode(array('status'=>'success','msg'=>'login successful'));
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    //$user->insertFailedAttempt((int)$result['user_id']);//TODO fix bug ERR_EMPTY_RESPONSE in ajax response error
                    return json_encode(array('status'=>'error','msg'=>'login ou mot de passe incorrect'));
                }
            }
        } else {
            //user do not exists in database
            return json_encode(array('status'=>'error','msg'=>'login ou mot de passe incorrect'));
        }

    }

    /**
     * Detect brute attack
     * @param $user_id user id
     * @return Boolean
     */
    function checkbrute($user_id) {
        $user = new User();
        return ($user->getLoginAttempts($user_id) > 5 ? true:false);
    }

    /**
     * Check if user is logged or not
     * @return Boolean
     */
    function login_check() {
        // Check if all session variables are set
        if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
            $user_id = $_SESSION['user_id'];
            $login_string = $_SESSION['login_string'];

            // Get the user-agent string of the user.
            $user_browser = $_SERVER['HTTP_USER_AGENT'];

            $user = new User();
            $result = $user->getUserById($user_id);
            if ($result) {
                $login_check = hash('sha512', $result['password'] . $user_browser);

                if ($login_check == $login_string) {
                    // Logged In!!!!
                    return true;
                } else {
                    // Not logged in
                    return false;
                }

            } else return false;
        }
    }

    /**
     * call login function after filtering inputs (email,password)
     * @return echo login() response
     */
    function processLogin() {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['p']; // The hashed password.

        echo $this->login($email,$password);
    }
}// END class

//check correct posts & call process function
if (isset($_POST['email'], $_POST['p'])) {
    $api = new loginProcess();
    $api->processLogin();
}
