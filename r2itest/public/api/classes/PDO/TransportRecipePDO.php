<?php
/**
 * Created by PhpStorm.
 * User: ilham
 * Date: 18/04/16
 * Time: 12:48 م
 */
class TransportRecipePDO extends Model{


    private static $db;


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
        self::$table = "transport_recipe";
    }





    public static function insertTransportRecipe($insert) {
        self::initialize();
        $result = self::$db->insert(self::$table,$insert);
        if($result) return array("done" =>true,"msg" =>"bien enregistré");
        else return array("done" =>false,"msg" =>"probléme d'enregistrement ");
    }


}// END class