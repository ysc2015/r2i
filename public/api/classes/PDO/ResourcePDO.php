<?php
/**
 * Ressources (Files) PDO class.
 * @author RR
 */

class ResourcePDO {

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
        self::$table = "resources";
    }

    /**
     * add resource file
     * @return bool
     */
    public static function insertResource($insert) {
        self::initialize();
        return self::$db->insert(self::$table,$insert);
    }

    /**
     * get resources files by object id and object type
     * @param int $object_id
     * @param string $object_type
     * @return array
     */
    public static function getResourcesByObjectIdAndObjectType($object_id,$object_type) {
        self::initialize();
        $bind = array(
            ":object_id" => $object_id,
            ":object_type" => $object_type
        );
        $result = self::$db->select(self::$table, "object_id = :object_id AND object_type = :object_type", $bind);
        if($result) return array("done" => true,"msg" => "fichiers récupérés", "data" => $result);
        else return array("done" =>false,"msg" =>"probléme récupération fichiers", "data" => []);
    }

    /**
     * delete resource file by resource id
     * @param array $delete
     * @return array
     */
    public static function deleteResourceFile($delete) {
        self::initialize();
        $bind = array(
            ":resource_id" => $delete['resid']
        );
        $result = self::$db->delete(self::$table,"resource_id = :resource_id", $bind);
        if($result) {
            unlink($delete['filepath']);
            return array("done" => true,"msg" => "fichier supprimé");
        }
        else return array("done" =>false,"msg" =>"probléme suppression fichier");
    }
}// END class