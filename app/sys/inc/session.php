<?php
/**
 * file: session.php
 * User: rabii
 */

//ini_set('session.use_only_cookies', 1);

class SessionManager
{


    //CONST session_name = "AzaZfeDgDhEtFEyuVkMolHcKKdIdgUhYtjPy";
    CONST session_keyname = "AzaZfeDgDhEtFEyuVkMolHcLLdIdgUhYtjPy";
    CONST interval = 0;

    public static function init(){
        //$cookieParams = session_get_cookie_params();
        //session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], false , true);

        //session_name(SessionManager::session_name);

        session_start();
        //session_regenerate_id();
    }

    private static function set($args, $save){
        if($save) setcookie(SessionManager::session_keyname, $args, time() + (SessionManager::interval * 24 * 60 * 60));
        $_SESSION[SessionManager::session_keyname] = $args;
    }

    private static function free(){
        unset($_COOKIE[SessionManager::session_keyname]);
        session_unset();
    }

    public static function check($callback){
        $logged = isset($_SESSION[SessionManager::session_keyname]) or isset($_COOKIE[SessionManager::session_keyname]);
        $arg = NULL;
        if($logged) $arg = isset($_SESSION[SessionManager::session_keyname]) ? $_SESSION[SessionManager::session_keyname] : $_COOKIE[SessionManager::session_keyname];
        if($arg != NULL){
            $arg = base64_decode($arg);
            $arg = explode("::", $arg);
        }
        $callback($logged, $arg);
    }

    public static function login($args, $save, $callback){
        $cookie = base64_encode(implode('::', array_map(function($arg){ return md5($arg); }, $args)));
        SessionManager::set($cookie, $save);
        $callback();
    }

    public static function logout($callback){
        SessionManager::free();
        $callback();
    }


}
?>