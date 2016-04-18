<?php
/**
 * Created by PhpStorm.
 * User: ilham
 * Date: 18/04/16
 * Time: 09:41 ص
 */
class PrepCartoPDO {


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
        self::$table = "prep_carto";
        //set upload directory
        self::$upload_dir = "../uploads/users/";
    }



    public static function insertprepCarto($insert) {
        self::initialize();
        $result = self::$db->insert(self::$table,$insert);
        if($result) return array("done" =>true,"msg" =>"bien enregistré");
        else return array("done" =>false,"msg" =>"probléme d'enregistrement ");
    }
}// E