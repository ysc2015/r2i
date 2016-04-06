<?php
/**
 * SD Files PDO class.
 * @author RR
 */

class SDFilePDO {

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
        self::$table = "project_sd_files";
    }

    /**
     * add sd file
     * @return bool
     */
    public static function insertSDFile($insert) {
        self::initialize();
        return self::$db->insert(self::$table,$insert);
        /*if($result) return array("done" =>true,"msg" =>"fichier enregistré");
        else return array("done" =>false,"msg" =>"probléme enregistrement fichier");*/
    }

    /**
     * get sd files by project id
     * @param array $project_id
     * @return array
     */
    public static function getProjectFilesByProjectId($project_id) {
        self::initialize();
        $bind = array(
            ":project_id" => $project_id
        );
        $result = self::$db->select(self::$table, "project_id = :project_id", $bind);
        if($result) return array("done" => true,"msg" => "fichiers récupérés", "data" => $result);
        else return array("done" =>false,"msg" =>"probléme récupération fichiers projets", "data" => []);
    }
}// END class