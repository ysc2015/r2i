<?php
/**
 * Job Order PDO class.
 * @author RR
 */

class JobOrderPDO {

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
        self::$table = "job_orders";
    }

    /**
     * add job order
     * @param array $insert
     * @return array
     */
    public static function insertJobOrder($insert) {
        self::initialize();

        $date = new DateTime('now');
        $toinsert = $insert;
        $toinsert['createdat'] = $date->format('Y-m-d H:i:s');

        $result = self::$db->insert(self::$table,$toinsert);
        if($result) {
            $lastInsertId = self::$db->lastInsertId();
            return array("done" =>true,"msg" =>"","id" => $lastInsertId);
        }
        else return array("done" =>false,"msg" =>"probléme enregistrement ordre de travail");
    }

    /**
     * check if job order exists of a specific entry
     * @return bool
     */
    public static function JobExists($object_id,$object_type) {
        self::initialize();
        //build sql query
        $sql ="SELECT * FROM ".self::$table." WHERE object_id =".$object_id." AND object_type='".$object_type."'";

        $result = self::$db->run($sql);

        return ($result ? true:false);
        //return $sql;
    }
}// END class