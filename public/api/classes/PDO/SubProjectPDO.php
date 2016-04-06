<?php
/**
 * Sub Project PDO class.
 * @author RR
 */

class SubProjectPDO {

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
     * Select sub projects of a given project (id)
     * @param int $projectid
     * @return array()
     */
    public static function getSubProjectsByProjectId($projectid) {
        self::initialize();
        $bind = array(
            ":project_id" => $projectid
        );
        return self::$db->select(self::$table, "project_id = :project_id", $bind);
    }

    /**
     * add sub project
     * @return bool
     */
    public static function insertSubProject($insert) {
        self::initialize();
        $result = self::$db->insert(self::$table,$insert);
        if($result) return array("done" =>true,"msg" =>"sous projet enregistré");
        else return array("done" =>false,"msg" =>"probléme enregistrement sous projet");
    }
}// END class