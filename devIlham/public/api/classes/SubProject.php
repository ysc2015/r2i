<?php
/**
 * Sub Project class.
 * @author RR
 */

class SubProject {

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
     * Select all sub projects
     * @return array
     */
    public function getAllSubProjects() {
        return $this->db->select("sub_projects");
    }

    /**
     * Select sub projects of a given project (id)
     * @param int $projectid
     * @return array() / boolean(false)
     */
    public function getSubProjectsByProjectId($projectid) {
        $bind = array(
            ":project_id" => $projectid
        );
        return $this->db->select("sub_projects", "project_id = :project_id", $bind);
    }
}// END class