<?php
/**
 * Profil class.
 * @author RR
 */

class Profil {

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
        //load database instance to $db
        $this->db = DB::getInstance();
    }

    /**
     * Select all profils
     * @return array
     */
    public function getAllProfils() {
        return $this->db->select("profils");
    }

}// END class