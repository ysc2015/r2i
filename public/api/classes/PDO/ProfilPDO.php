<?php
/**
 * Profil PDO class.
 * @author RR
 */

class ProfilPDO {

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
        self::$table = "profils";
    }

    /**
     * get all profils (excepts root)
     * @return array
     */
    public static function getAllProfils() {
        self::initialize();
        //build sql query
        $sql ="SELECT * FROM ".self::$table." WHERE profil_id != 1 ";
        $sql .="ORDER BY profil_id ASC";

        $result = self::$db->run($sql);

        if($result) return array("done" => true,"msg" => "profils récupérés", "data" => $result);
        else return array("done" =>false,"msg" =>"probléme récupération profils", "data" => []);
    }
}// END class