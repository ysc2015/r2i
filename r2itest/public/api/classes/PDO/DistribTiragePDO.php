<?php
/**
 * Created by PhpStorm.
 * User: ilham
 * Date: 18/04/16
 * Time: 03:31 م
 */
class DistribTiragePDO {


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
        self::$table = "distrib_tirage";
        //set upload directory
        self::$upload_dir = "../uploads/users/";
    }



    public static function insertDistribTirage($insert) {
        self::initialize();
        $result = self::$db->insert(self::$table,$insert);
        if($result) return array("done" =>true,"msg" =>"bien enregistré");
        else return array("done" =>false,"msg" =>"probléme d'enregistrement !");
    }
}// E