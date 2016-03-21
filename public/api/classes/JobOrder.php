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
     * Select jobs orders records to synchronize with mobile app
     * @param array $param (user_id)
     * @return array
     */
    public function getJobsToSynchronize($param) {
        $bind = array(
            ":user_id" => $param['uid'],
            ":flag" => 'yes'
        );
        //SQL
        $result = $this->db->select("job_orders", "flag = :flag  AND user_id = :user_id", $bind);/* AND user_id = :user_id*/
        return $result;
    }

    /**
     * Update from list
     * @return bool
     */
    public function resetUpdateFlagFromList($list) {
        //SQL
        $sql = "update job_orders ";
        $sql .="set flag = '' ";
        $sql .="where job_order_id in ".$list['list'];
        $result = $this->db->run($sql);
        return $result;
    }


}// END class