<?php
/**
 * File model class
 */

class File {
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
     * Add a file
     * @param array $insert values
     * @return array|bool|int
     */
    public function insertFile($insert) {
        return $this->db->insert("files", $insert);
    }


}// END class