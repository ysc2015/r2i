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
            ":flag1" => 'to_update',
            ":flag2" => 'to_insert'
        );
        //SQL
        $sql = "select * from rooms_list ";
        $sql .="where flag = :flag1 or flag = :flag2;";
        $result = $this->db->run($sql,$bind);
        return $result;
    }


}// END class