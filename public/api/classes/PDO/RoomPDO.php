<?php
/**
 * Room PDO class.
 * @author RR
 */

class RoomPDO {

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
        self::$table = "rooms";
    }

    /**
     * get objects rooms
     * @param string $object_type
     * @praram int $object_id
     * @return array
     */
    public static function getObjectRooms($object_type,$object_id) {
        self::initialize();
        //build sql query
        $sql ="SELECT * FROM ".self::$table." WHERE object_source =".$object_type." ";
        $sql .="AND object_id=".$object_id;

        $result = self::$db->run($sql);

        if($result) return array("done" => true,"msg" => "chambres récupérées", "data" => $result);
        else return array("done" =>false,"msg" =>"probléme récupération chambres", "data" => []);
    }
}// END class