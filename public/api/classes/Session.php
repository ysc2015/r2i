<?php
/**
 * Session class.
 * @author RR
 */

class Session {
    private $session_name;
    private $secure;
    private $httponly;

    /**
     * Constructor function.
     */
    public function __construct() {
        //custom session name
        $this->session_name = 'r2i7604w@r11!n79w@shere!';
        $this->secure = false;

        // This stops JavaScript being able to access the session id.
        $this->httponly = true;

        // Forces sessions to only use cookies.
        ini_set('session.use_only_cookies', 1);
    }

    /**
     * start secured session
     */
    public function sec_session_start() {

        // Gets current cookies params.
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $this->secure, $this->httponly);

        // Sets the session name to the one set above.
        session_name($this->session_name);

        session_start();            // Start the PHP session
        session_regenerate_id();    // regenerated the session, delete the old one.
    }
}// END class