<?php
/**
 * Project class.
 * @author RR
 */

class Project {

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
     * Select all projects from DB
     * @return array
     */
    public function getAllProjects() {
        //build sql query
        $sql ="SELECT project_id,project_name,city,plate_dept_code, ";
        $sql .="site_code,type_site_id,size,orig_site_state_id,orig_site_provision_date ";
        $sql .="FROM projects ";
        $sql .="ORDER BY projects.project_id ASC";

        //run & retun sql result(array)

        return $this->db->run($sql);
    }




    /**
     * Select project files by folder
     * @param Int $idp values
     * @param String $foldername values
     * @return array
     */
    public function getProjectFilesByFolder($idp,$foldername) {
        $bind = array(
            ":project_id" => $idp,
            ":folder_name" => $foldername
        );
        //SQL
        $sql = "select f.* ";
        $sql .="from files as f ";
        $sql .="inner join projects as p on f.project_id = p.project_id ";
        $sql .="inner join folders as fo on f.folder_id = fo.folder_id ";
        $sql .="where f.project_id = :project_id AND fo.folder_name = :folder_name ";
        $result = $this->db->run($sql,$bind);
        return $result;
    }

    /**
     * Add a project
     * @param array $insert values
     * @return array|bool|int
     */
    public function insertProject($insert) {
        $result = $this->db->insert("projects", $insert);
        return array("data" =>$result,"insertedId" =>$this->db->lastInsertId());
    }

    /**
     * Update a project
     * @param array $update values
     * @return array|bool|int
     */

    public function updateProject($update) {
        $bind = array(
            ":project_id" => $update['project_id']
        );
        var_dump($update);
        return $this->db->update("projects", $update['info'], "project_id = :project_id", $bind);
    }


    public function getProjectsbyid($project_id) {
        $bind = array(
            ":project_id" => $project_id
        );
        $result = $this->db->select("projects", "project_id = :project_id", $bind);
        return (!empty($result) ? $result[0] : false);
    }
    /**
     * Delete a project
     * @param array $delete
     * @return array|bool|int
     */
    public function deleteProject($delete) {
        $bind = array(
            ":project_id" => $delete['project_id']
        );
        return $this->db->delete("projects","project_id = :project_id", $bind);
    }

    /**
     * validation functions
     */
    private function isValidData(/*$data,$method*/) {
        return true;
    }
}// END class