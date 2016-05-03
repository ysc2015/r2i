<?php
/**
 * Dist Switch entry PDO class.
 * @author RR
 */

class DistSwitchEntryPDO {

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
        self::$table = "distswitch";
        self::$entry_name = "distribution/aiguillage";
        //set upload directory
        self::$upload_dir = "../../uploads/fichiersprojets/";
    }

    /**
     * add distribution switch entry
     * @return bool
     */
    public static function insertDistSwitchEntry($insert) {
        self::initialize();

        $date = new DateTime('now');
        $toinsert = $insert;
        $toinsert['createdAt'] = $date->format('Y-m-d H:i:s');

        $toinsert['plan_trans_date'] = ($insert['plan_trans_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['plan_trans_date'])->format('Y-m-d'):null);
        $toinsert['switch_date'] = ($insert['switch_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['switch_date'])->format('Y-m-d'):null);
        $toinsert['start_control_date'] = ($insert['start_control_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['start_control_date'])->format('Y-m-d'):null);
        $toinsert['ret_date'] = ($insert['ret_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['ret_date'])->format('Y-m-d'):null);

        $result = self::$db->insert(self::$table,$toinsert);
        if($result) {
            $lastInsertId = self::$db->lastInsertId();
            return array("done" =>true,"msg" =>"entréé ".self::$entry_name." crée pour le sous projet en cours.","id" => $lastInsertId);
        }
        else return array("done" =>false,"msg" =>"probléme enregistrement entrée ".self::$entry_name);
    }

    /**
     * update distribution switch entry
     * @param array $update
     * @return array
     */
    public static function updateDistSwitchEntry($update) {
        self::initialize();
        $bind = array(
            ":distswitch_id" => $update['distswitch_id']
        );

        $date = new DateTime('now');
        $toupdate = $update;
        $toupdate['updatedAt'] = $date->format('Y-m-d H:i:s');

        $toupdate['plan_trans_date'] = ($update['plan_trans_date']!=""?DateTime::createFromFormat('d/m/Y', $update['plan_trans_date'])->format('Y-m-d'):null);
        $toupdate['switch_date'] = ($update['switch_date']!=""?DateTime::createFromFormat('d/m/Y', $update['switch_date'])->format('Y-m-d'):null);
        $toupdate['start_control_date'] = ($update['start_control_date']!=""?DateTime::createFromFormat('d/m/Y', $update['start_control_date'])->format('Y-m-d'):null);
        $toupdate['ret_date'] = ($update['ret_date']!=""?DateTime::createFromFormat('d/m/Y', $update['ret_date'])->format('Y-m-d'):null);

        try {
            $result = self::$db->update(self::$table, $toupdate, "distswitch_id = :distswitch_id", $bind);
            if($result) return array("done" =>true,"msg" =>"entréé ".self::$entry_name." mis à jour");
            else return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        } catch(Exception $e) {
            self::logIt($e->getMessage());
            return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        }

        //return array("done" =>false,"msg" =>$toupdate['auto_adduction_date']);
    }

    /**
     * get distribution switch entry by id
     * @param int $distswitch_id
     * @return array
     */
    public static function getDistSwitchById($distswitch_id) {
        self::initialize();
        $bind = array(
            ":distswitch_id" => $distswitch_id
        );
        return self::$db->select(self::$table, "distswitch_id = :distswitch_id", $bind)[0];
    }

    /**
     * get dist switch entry link by zone id
     * @param int $zone_id
     * @return array
     */
    public static function getDistSwitchLinkByZoneId($zone_id) {
        self::initialize();
        $bind = array(
            ":zone_id" => $zone_id
        );
        $result = self::$db->select(self::$table, "zone_id = :zone_id", $bind);

        if($result) return array("link" => "?page=distswitch&action=edit&distswitchid=".$result[0]["distswitch_id"], "class" => "label-primary", "title" => "ouvrir");
        else return array("link" => "?page=distswitch&action=add&zoneid=".$zone_id, "class" => "label-success", "title" => "créer");
    }
}// END class