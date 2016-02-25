<?php
/**
 * JobRoom model class
 */

class JobRoom {
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
     * Select room records to synchronize with mobile app
     * @return array
     */
    public function getRoomsToSynchronize() {
        $bind = array(
            ":flag" => 'yesz'
        );
        //SQL
        $result = $this->db->select("rooms_list", "flag = :flag", $bind);
        return $result;
    }


}// END class