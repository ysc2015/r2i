<?php
/**
 * Transport Switch entry PDO class.
 * @author RR
 */

class TransportSwitchEntryPDO {

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
     * Upload directory
     * @var String
     * @access private
     */
    private static $upload_dir;

    /**
     * Entry name
     * @var String
     * @access private
     */
    private static $entry_name;

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
        self::$table = "transportswitch";
        self::$entry_name = "transport/aiguillage";
        //set upload directory
        self::$upload_dir = "../../uploads/fichiersprojets/";
    }

    /**
     * add transport switch entry
     * @return bool
     */
    public static function insertTransportSwitchEntry($insert) {
        self::initialize();

        $date = new DateTime('now');
        $toinsert = $insert;
        $toinsert['createdAt'] = $date->format('Y-m-d H:i:s');

        $toinsert['plans_transmission_date'] = ($insert['plans_transmission_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['plans_transmission_date'])->format('Y-m-d'):null);
        $toinsert['switch_date'] = ($insert['switch_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['switch_date'])->format('Y-m-d'):null);
        $toinsert['ret_date_prev'] = ($insert['ret_date_prev']!=""?DateTime::createFromFormat('d/m/Y', $insert['ret_date_prev'])->format('Y-m-d'):null);
        $toinsert['start_control_report_date'] = ($insert['start_control_report_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['start_control_report_date'])->format('Y-m-d'):null);
        $toinsert['ret_date'] = ($insert['ret_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['ret_date'])->format('Y-m-d'):null);
        
        $result = self::$db->insert(self::$table,$toinsert);
        if($result) {
            $lastInsertId = self::$db->lastInsertId();
            return array("done" =>true,"msg" =>"entréé ".self::$entry_name." crée pour le sous projet en cours.","id" => $lastInsertId);
        }
        else return array("done" =>false,"msg" =>"probléme enregistrement entrée ".self::$entry_name);
    }

    /**
     * update transport switch entry
     * @param array $update
     * @return array
     */
    public static function updateTransportSwitchEntry($update) {
        self::initialize();
        $bind = array(
            ":transportswitch_id" => $update['transportswitch_id']
        );

        $date = new DateTime('now');
        $toupdate = $update;
        $toupdate['updatedAt'] = $date->format('Y-m-d H:i:s');
        $toupdate['plans_transmission_date'] = ($update['plans_transmission_date']!=""?DateTime::createFromFormat('d/m/Y', $update['plans_transmission_date'])->format('Y-m-d'):null);
        $toupdate['switch_date'] = ($update['switch_date']!=""?DateTime::createFromFormat('d/m/Y', $update['switch_date'])->format('Y-m-d'):null);
        $toupdate['ret_date_prev'] = ($update['ret_date_prev']!=""?DateTime::createFromFormat('d/m/Y', $update['ret_date_prev'])->format('Y-m-d'):null);
        $toupdate['start_control_report_date'] = ($update['start_control_report_date']!=""?DateTime::createFromFormat('d/m/Y', $update['start_control_report_date'])->format('Y-m-d'):null);
        $toupdate['ret_date'] = ($update['ret_date']!=""?DateTime::createFromFormat('d/m/Y', $update['ret_date'])->format('Y-m-d'):null);

        try {
            $result = self::$db->update(self::$table, $toupdate, "transportswitch_id = :transportswitch_id", $bind);
            if($result) return array("done" =>true,"msg" =>"entréé ".self::$entry_name." mis à jour");
            else return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        } catch(Exception $e) {
            self::logIt($e->getMessage());
            return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        }

        //return array("done" =>false,"msg" =>$toupdate['auto_adduction_date']);
    }

    /**
     * set job order id
     * @param array $update
     * @return bool
     */
    public static function setTransportSwitchOT($update) {
        self::initialize();
        //build sql
        $sql ="update ".self::$table." set job_order_id=".$update['jobid']." where transportswitch_id=".$update['objid'];

        try {
            $result = self::$db->run($sql);
            if($result) return array("done" =>false,"msg" =>"ordre de travail crée");
            else return array("done" =>false,"msg" =>"probléme création ordre de travail");
        } catch(Exception $e) {
            self::logIt($e->getMessage());
            return array("done" =>false,"msg" =>"erreur création ordre de travail");
        }

        //return array("done" =>false,"msg" =>$toupdate['auto_adduction_date']);
    }

    /**
     * get transport switch entry by id
     * @param int $transportswitch_id
     * @return array
     */
    public static function getTransportSwitchById($transportswitch_id) {
        self::initialize();
        $bind = array(
            ":transportswitch_id" => $transportswitch_id
        );
        return self::$db->select(self::$table, "transportswitch_id = :transportswitch_id", $bind)[0];
    }

    /**
     * get transport switch entry link by zone id
     * @param int $zone_id
     * @return array
     */
    public static function getTransportSwitchLinkByZoneId($zone_id) {
        self::initialize();
        $bind = array(
            ":zone_id" => $zone_id
        );
        $result = self::$db->select(self::$table, "zone_id = :zone_id", $bind);

        if($result) return array("link" => "?page=transportswitch&action=edit&transportswitchid=".$result[0]["transportswitch_id"], "class" => "label-primary", "title" => "ouvrir");
        else return array("link" => "?page=transportswitch&action=add&zoneid=".$zone_id, "class" => "label-success", "title" => "créer");
    }
}// END class