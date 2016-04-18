<?php
/**
 * Created by PhpStorm.
 * User: ilham
 * Date: 17/04/16
 * Time: 08:39 م
 */
class PhasePDO {


    private static $db;


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
        self::$table = "phase";
        //set upload directory
        self::$upload_dir = "../uploads/users/";
    }



    public static function insertphase($insert) {
        self::initialize();
        $result = self::$db->insert(self::$table,$insert);
        if($result) return array("done" =>true,"msg" =>"Phase enregistré");
        else return array("done" =>false,"msg" =>"probléme enregistrement Phase");
    }
}// E