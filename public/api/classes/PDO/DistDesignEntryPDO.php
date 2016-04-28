<?php
/**
 * Dist Design entry PDO class.
 * @author RR
 */

class DistDesignEntryPDO {

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
        self::$table = "distdesign";
        self::$entry_name = "distribution/design";
        //set upload directory
        self::$upload_dir = "../../uploads/fichiersprojets/";
    }

    /**
     * add dist design entry
     * @return bool
     */
    public static function insertDistDesignEntry($insert) {
        self::initialize();

        $date = new DateTime('now');
        $toinsert = $insert;
        $toinsert['createdAt'] = $date->format('Y-m-d H:i:s');

        $toinsert['start_date'] = ($insert['start_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['start_date'])->format('Y-m-d'):null);
        $toinsert['end_date'] = ($insert['end_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['end_date'])->format('Y-m-d'):null);
        $toinsert['send_date'] = ($insert['send_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['send_date'])->format('Y-m-d'):null);

        $result = self::$db->insert(self::$table,$toinsert);
        if($result) {
            $lastInsertId = self::$db->lastInsertId();
            return array("done" =>true,"msg" =>"entréé ".self::$entry_name." crée pour le sous projet en cours.","id" => $lastInsertId);
        }
        else return array("done" =>false,"msg" =>"probléme enregistrement entrée ".self::$entry_name);
    }

    /**
     * update dist design entry
     * @param array $update
     * @return array
     */
    public static function updateDistDesignEntry($update) {
        self::initialize();
        $bind = array(
            ":distdesign_id" => $update['distdesign_id']
        );

        $date = new DateTime('now');
        $toupdate = $update;
        $toupdate['updatedAt'] = $date->format('Y-m-d H:i:s');

        $toupdate['start_date'] = ($update['start_date']!=""?DateTime::createFromFormat('d/m/Y', $update['start_date'])->format('Y-m-d'):null);
        $toupdate['end_date'] = ($update['end_date']!=""?DateTime::createFromFormat('d/m/Y', $update['end_date'])->format('Y-m-d'):null);
        $toupdate['send_date'] = ($update['send_date']!=""?DateTime::createFromFormat('d/m/Y', $update['send_date'])->format('Y-m-d'):null);

        try {
            $result = self::$db->update(self::$table, $toupdate, "distdesign_id = :distdesign_id", $bind);
            if($result) return array("done" =>true,"msg" =>"entréé ".self::$entry_name." mis à jour");
            else return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        } catch(Exception $e) {
            self::logIt($e->getMessage());
            return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        }

        //return array("done" =>false,"msg" =>$toupdate['auto_adduction_date']);
    }

    /**
     * get dist design entry by id
     * @param int $distdesign_id
     * @return array
     */
    public static function getDistDesignById($distdesign_id) {
        self::initialize();
        $bind = array(
            ":distdesign_id" => $distdesign_id
        );
        return self::$db->select(self::$table, "distdesign_id = :distdesign_id", $bind)[0];
    }
}// END class