<?php
/**
 * SDFile class.
 * @author RR
 */

class SDFile extends Model {

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
        parent::__construct();
        //load database instance to $db
        $this->db = DB::getInstance();
    }

    /**
     * Add an sd file
     * @param array $insert
     * @return bool
     */
    public function insertSDFile($insert) {
        return $result = $this->db->insert("project_sd_files", $insert);
    }

}// END class