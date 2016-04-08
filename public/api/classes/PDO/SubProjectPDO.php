<?php
/**
 * Sub Project PDO class.
 * @author RR
 */

class SubProjectPDO extends Model{

    /**
     * Database Instance
     * @var PDO object
     * @access private
     */
    private static $db;

    /**
     * Table name
     * @var string
     * @access private
     */
    private static $table;

    /**
     * Initialize indicator
     * @var bool
     * @access private
     */
    private static $initialized = false;

    /**
     * initialize function.
     */
    public static function initialize() {

        if (self::$initialized)
            return;

        //load database instance
        self::$db = DB::getInstance();
        //set table name
        self::$table = "sub_projects";
    }

    /**
     * Select all sub projects
     * @return array
     */
    public static function getAllSubProjects() {
        self::initialize();
        return self::$db->select(self::$table);
    }

    /**
     * get sub project by id
     * @param array $sub_project_id
     * @return array
     */
    public static function getSubProjectById($sub_project_id) {
        self::initialize();
        $bind = array(
            ":sub_project_id" => $sub_project_id
        );
        return self::$db->select(self::$table, "sub_project_id = :sub_project_id", $bind)[0];
    }

    /**
     * Select sub projects of a given project (id)
     * @param int $projectid
     * @return array()
     */
    public static function getSubProjectsByProjectId($projectid) {
        self::initialize();

        //build sql query
        $sql ="SELECT * FROM ".self::$table." WHERE project_id = ".$projectid. " ";
        $sql .="ORDER BY sub_project_id DESC";

        $bind = array(
            ":project_id" => $projectid
        );
        $result = self::$db->run($sql,$bind);

        if($result) return array("done" => true,"msg" => "sous projets récupérés", "data" => $result);
        else return array("done" =>false,"msg" =>"probléme récupération sous projets", "data" => []);
    }

    /**
     * add sub project
     * @param array $insert
     * @return array
     */
    public static function insertSubProject($insert) {
        self::initialize();

        $date = new DateTime('now');
        $toinsert = $insert;
        $toinsert['createdAt'] = $date->format('Y-m-d H:i:s');

        $toinsert['auto_adduction_date'] = DateTime::createFromFormat('d/m/Y', $insert['auto_adduction_date'])->format('Y-m-d');
        $toinsert['works_adduction_date'] = DateTime::createFromFormat('d/m/Y', $insert['works_adduction_date'])->format('Y-m-d');
        $toinsert['adduction_recipe_date'] = DateTime::createFromFormat('d/m/Y', $insert['adduction_recipe_date'])->format('Y-m-d');

        $result = self::$db->insert(self::$table,$toinsert);
        if($result) return array("done" =>true,"msg" =>"sous projet enregistré");
        else return array("done" =>false,"msg" =>"probléme enregistrement sous projet");
    }

    /**
     * update sub project
     * @param array $update
     * @return array
     */
    public static function updateSubProject($update) {
        self::initialize();
        $bind = array(
            ":sub_project_id" => $update['sub_project_id']
        );

        $date = new DateTime('now');
        $toupdate = $update;
        $toupdate['updatedAt'] = $date->format('Y-m-d H:i:s');

        $toupdate['auto_adduction_date'] = ($update['auto_adduction_date']!=""?DateTime::createFromFormat('d/m/Y', $update['auto_adduction_date'])->format('Y-m-d'):null);
        $toupdate['works_adduction_date'] = ($update['works_adduction_date']!=""?DateTime::createFromFormat('d/m/Y', $update['works_adduction_date'])->format('Y-m-d'):null);
        $toupdate['adduction_recipe_date'] = ($update['adduction_recipe_date']!=""?DateTime::createFromFormat('d/m/Y', $update['adduction_recipe_date'])->format('Y-m-d'):null);

        try {
            $result = self::$db->update(self::$table, $toupdate, "sub_project_id = :sub_project_id", $bind);
            if($result) return array("done" =>true,"msg" =>"sous projet mis à jour");
            else return array("done" =>false,"msg" =>"probléme mise à jour sous projet");
        } catch(Exception $e) {
            self::logIt($e->getMessage());
            return array("done" =>false,"msg" =>"probléme mise à jour sous projet");
        }

        //return array("done" =>false,"msg" =>$toupdate['auto_adduction_date']);
    }
}// END class