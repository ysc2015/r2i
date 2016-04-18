<?php


class TransportRaccoPDO extends Model{


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
        self::$table = "transport_racco";
    }





    public static function insertTransportRacco($insert) {
        self::initialize();
        $result = self::$db->insert(self::$table,$insert);
        if($result) return array("done" =>true,"msg" =>"bien enregistré");
        else return array("done" =>false,"msg" =>"probléme d'enregistrement ");
    }


}// END class