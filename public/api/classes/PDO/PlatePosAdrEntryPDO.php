<?php
/**
 * Plate Pos Adr entry PDO class.
 * @author RR
 */

class PlatePosAdrEntryPDO {

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
        self::$table = "plateposadr";
        self::$entry_name = "préparation plaque/positionnement des Adresses";
        //set upload directory
        self::$upload_dir = "../../uploads/fichiersprojets/";
    }

    /**
     * add plate pos adr entry
     * @return bool
     */
    public static function insertPlatePosAdrEntry($insert) {
        self::initialize();

        $date = new DateTime('now');
        $toinsert = $insert;
        $toinsert['createdAt'] = $date->format('Y-m-d H:i:s');

        $toinsert['start_date'] = ($insert['start_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['start_date'])->format('Y-m-d'):null);
        $toinsert['prev_ret_date'] = ($insert['prev_ret_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['prev_ret_date'])->format('Y-m-d'):null);

        $result = self::$db->insert(self::$table,$toinsert);
        if($result) {
            $lastInsertId = self::$db->lastInsertId();
            return array("done" =>true,"msg" =>"entréé ".self::$entry_name." crée pour le sous projet en cours.","id" => $lastInsertId);
        }
        else return array("done" =>false,"msg" =>"probléme enregistrement entrée ".self::$entry_name);
    }

    /**
     * update plate pos adr entry
     * @param array $update
     * @return array
     */
    public static function updatePlatePosAdrEntry($update) {
        self::initialize();
        $bind = array(
            ":plateposadr_id" => $update['plateposadr_id']
        );

        $date = new DateTime('now');
        $toupdate = $update;
        $toupdate['updatedAt'] = $date->format('Y-m-d H:i:s');

        $toupdate['start_date'] = ($update['start_date']!=""?DateTime::createFromFormat('d/m/Y', $update['start_date'])->format('Y-m-d'):null);
        $toupdate['prev_ret_date'] = ($update['prev_ret_date']!=""?DateTime::createFromFormat('d/m/Y', $update['prev_ret_date'])->format('Y-m-d'):null);

        try {
            $result = self::$db->update(self::$table, $toupdate, "plateposadr_id = :plateposadr_id", $bind);
            if($result) return array("done" =>true,"msg" =>"entréé ".self::$entry_name." mis à jour");
            else return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        } catch(Exception $e) {
            self::logIt($e->getMessage());
            return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        }

        //return array("done" =>false,"msg" =>$toupdate['auto_adduction_date']);
    }

    /**
     * get plate pos adr entry by id
     * @param int $plateposadr_id
     * @return array
     */
    public static function getPlatePosAdrById($plateposadr_id) {
        self::initialize();
        $bind = array(
            ":plateposadr_id" => $plateposadr_id
        );
        return self::$db->select(self::$table, "plateposadr_id = :plateposadr_id", $bind)[0];
    }
}// END class