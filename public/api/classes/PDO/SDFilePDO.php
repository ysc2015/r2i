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
     * Upload directory
     * @var String
     * @access private
     */
    private static $upload_dir;

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
        //set upload directory
        self::$upload_dir = "../../uploads/fichiersprojets/";
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

    /**
     * delete sd file by id
     * @param array $delete
     * @return bool
     */
    public static function deleteProjectSDFile($delete) {
        self::initialize();
        $bind = array(
            ":project_sd_file_id" => $delete['project_sd_file_id']
        );
        $result = self::$db->delete(self::$table,"project_sd_file_id = :project_sd_file_id", $bind);
        if($result) {
            unlink(self::$upload_dir . $delete['filename']);
            return array("done" => true,"msg" => "fichier supprimé");
        }
        else return array("done" =>false,"msg" =>"probléme suppression fichier");
    }
}// END class