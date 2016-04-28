<?php
/**
 * Transport Connect entry PDO class.
 * @author RR
 */

class TransportConnectEntryPDO {

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
        self::$table = "transportconnect";
        self::$entry_name = "transport/raccordements";
        //set upload directory
        self::$upload_dir = "../../uploads/fichiersprojets/";
    }

    /**
     * add transport connect entry
     * @return bool
     */
    public static function insertTransportConnectEntry($insert) {
        self::initialize();

        $date = new DateTime('now');
        $toinsert = $insert;
        $toinsert['createdAt'] = $date->format('Y-m-d H:i:s');

        $toinsert['pds_trans_date'] = ($insert['pds_trans_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['pds_trans_date'])->format('Y-m-d'):null);
        $toinsert['start_control_eff_date'] = ($insert['start_control_eff_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['start_control_eff_date'])->format('Y-m-d'):null);
        $toinsert['ret_date'] = ($insert['ret_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['ret_date'])->format('Y-m-d'):null);

        $result = self::$db->insert(self::$table,$toinsert);
        if($result) {
            $lastInsertId = self::$db->lastInsertId();
            return array("done" =>true,"msg" =>"entréé ".self::$entry_name." crée pour le sous projet en cours.","id" => $lastInsertId);
        }
        else return array("done" =>false,"msg" =>"probléme enregistrement entrée ".self::$entry_name);
    }

    /**
     * update transport connect entry
     * @param array $update
     * @return array
     */
    public static function updateTransportConnectEntry($update) {
        self::initialize();
        $bind = array(
            ":transportconnect_id" => $update['transportconnect_id']
        );

        $date = new DateTime('now');
        $toupdate = $update;
        $toupdate['updatedAt'] = $date->format('Y-m-d H:i:s');

        $toupdate['pds_trans_date'] = ($update['pds_trans_date']!=""?DateTime::createFromFormat('d/m/Y', $update['pds_trans_date'])->format('Y-m-d'):null);
        $toupdate['start_control_eff_date'] = ($update['start_control_eff_date']!=""?DateTime::createFromFormat('d/m/Y', $update['start_control_eff_date'])->format('Y-m-d'):null);
        $toupdate['ret_date'] = ($update['ret_date']!=""?DateTime::createFromFormat('d/m/Y', $update['ret_date'])->format('Y-m-d'):null);

        try {
            $result = self::$db->update(self::$table, $toupdate, "transportconnect_id = :transportconnect_id", $bind);
            if($result) return array("done" =>true,"msg" =>"entréé ".self::$entry_name." mis à jour");
            else return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        } catch(Exception $e) {
            self::logIt($e->getMessage());
            return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        }

        //return array("done" =>false,"msg" =>$toupdate['auto_adduction_date']);
    }

    /**
     * get transport connect entry by id
     * @param int $transportconnect_id
     * @return array
     */
    public static function getTransportConnectById($transportconnect_id) {
        self::initialize();
        $bind = array(
            ":transportconnect_id" => $transportconnect_id
        );
        return self::$db->select(self::$table, "transportconnect_id = :transportconnect_id", $bind)[0];
    }
}// END class