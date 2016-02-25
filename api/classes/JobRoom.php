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
            ":flag" => 'yes'
        );
        //SQL
        $sql = "select * from rooms_list ";
        $sql .="where flag = :flag ";
        $result = $this->db->run($sql,$bind);
        return $result;
    }


}// END class