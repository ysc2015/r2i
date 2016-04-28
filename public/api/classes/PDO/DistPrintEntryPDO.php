<?php
/**
 * Dist Print entry PDO class.
 * @author RR
 */

class DistPrintEntryPDO {

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
        self::$table = "distprint";
        self::$entry_name = "distribution/tirage";
        //set upload directory
        self::$upload_dir = "../../uploads/fichiersprojets/";
    }

    /**
     * add dist print entry
     * @return bool
     */
    public static function insertDistPrintEntry($insert) {
        self::initialize();

        $date = new DateTime('now');
        $toinsert = $insert;
        $toinsert['createdAt'] = $date->format('Y-m-d H:i:s');

        $toinsert['previs_date'] = ($insert['previs_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['previs_date'])->format('Y-m-d'):null);
        $toinsert['plan_trans_date'] = ($insert['plan_trans_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['plan_trans_date'])->format('Y-m-d'):null);
        $toinsert['print_date'] = ($insert['print_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['print_date'])->format('Y-m-d'):null);
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
     * update dist print entry
     * @param array $update
     * @return array
     */
    public static function updateDistPrintEntry($update) {
        self::initialize();
        $bind = array(
            ":distprint_id" => $update['distprint_id']
        );

        $date = new DateTime('now');
        $toupdate = $update;
        $toupdate['updatedAt'] = $date->format('Y-m-d H:i:s');

        $toupdate['previs_date'] = ($update['previs_date']!=""?DateTime::createFromFormat('d/m/Y', $update['previs_date'])->format('Y-m-d'):null);
        $toupdate['plan_trans_date'] = ($update['plan_trans_date']!=""?DateTime::createFromFormat('d/m/Y', $update['plan_trans_date'])->format('Y-m-d'):null);
        $toupdate['print_date'] = ($update['print_date']!=""?DateTime::createFromFormat('d/m/Y', $update['print_date'])->format('Y-m-d'):null);
        $toupdate['start_control_date'] = ($update['start_control_date']!=""?DateTime::createFromFormat('d/m/Y', $update['start_control_date'])->format('Y-m-d'):null);
        $toupdate['ret_date'] = ($update['ret_date']!=""?DateTime::createFromFormat('d/m/Y', $update['ret_date'])->format('Y-m-d'):null);

        try {
            $result = self::$db->update(self::$table, $toupdate, "distprint_id = :distprint_id", $bind);
            if($result) return array("done" =>true,"msg" =>"entréé ".self::$entry_name." mis à jour");
            else return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        } catch(Exception $e) {
            self::logIt($e->getMessage());
            return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        }

        //return array("done" =>false,"msg" =>$toupdate['auto_adduction_date']);
    }

    /**
     * get dist print entry by id
     * @param int $distprint_id
     * @return array
     */
    public static function getDistPrintById($distprint_id) {
        self::initialize();
        $bind = array(
            ":distprint_id" => $distprint_id
        );
        return self::$db->select(self::$table, "distprint_id = :distprint_id", $bind)[0];
    }
}// END class