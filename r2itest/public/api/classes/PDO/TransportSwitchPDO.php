<?php


class TransportSwitchPDO extends Model{


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
        self::$table = "transport_switch";
    }





    public static function insertTransportSwith($insert) {
        self::initialize();
        $result = self::$db->insert(self::$table,$insert);
        if($result) return array("done" =>true,"msg" =>"transport switch enregistré");
        else return array("done" =>false,"msg" =>"probléme enregistrement transport switch");
    }


}// END class