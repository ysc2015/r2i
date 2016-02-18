<?php
/**
 * JobOrder model class
 */

class JobOrder {
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
     * Check & get update
     * @return array|bool
     */
    public function getUpdate() {
        $bind = array(
            ":flag" => 'update'
        );
        $result = $this->db->select("job_orders", "flag = :flag", $bind);
        return (!empty($result)?$result:false);
    }


}// END class