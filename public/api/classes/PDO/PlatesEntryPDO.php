<?php
/**
 * Plates entry PDO class.
 * @author RR
 */

class PlatesEntryPDO {

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
        self::$table = "plates";
        self::$entry_name = "gestion plaque";
        //set upload directory
        self::$upload_dir = "../../uploads/fichiersprojets/";
    }

    /**
     * add plates entry
     * @return array
     */
    public static function insertPlatesEntry($insert) {
        self::initialize();

        $date = new DateTime('now');
        $toinsert = $insert;
        $toinsert['createdAt'] = $date->format('Y-m-d H:i:s');

        $toinsert['launch_date'] = ($insert['launch_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['launch_date'])->format('Y-m-d'):null);

        $result = self::$db->insert(self::$table,$toinsert);
        if($result) {
            $lastInsertId = self::$db->lastInsertId();
            return array("done" =>true,"msg" =>"entréé ".self::$entry_name." crée pour le sous projet en cours.","id" => $lastInsertId);
        }
        else return array("done" =>false,"msg" =>"probléme enregistrement entrée ".self::$entry_name);
    }

    /**
     * update plates entry
     * @param array $update
     * @return array
     */
    public static function updatePlatesEntry($update) {
        self::initialize();
        $bind = array(
            ":plate_id" => $update['plate_id']
        );

        $date = new DateTime('now');
        $toupdate = $update;
        $toupdate['updatedAt'] = $date->format('Y-m-d H:i:s');

        $toupdate['launch_date'] = ($update['launch_date']!=""?DateTime::createFromFormat('d/m/Y', $update['launch_date'])->format('Y-m-d'):null);

        try {
            $result = self::$db->update(self::$table, $toupdate, "plate_id = :plate_id", $bind);
            if($result) return array("done" =>true,"msg" =>"entréé ".self::$entry_name." mis à jour");
            else return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        } catch(Exception $e) {
            self::logIt($e->getMessage());
            return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        }

        //return array("done" =>false,"msg" =>$toupdate['auto_adduction_date']);
    }

    /**
     * get plates entry by id
     * @param int $plates_id
     * @return array
     */
    public static function getPlatesById($plates_id) {
        self::initialize();
        $bind = array(
            ":plate_id" => $plates_id
        );
        return self::$db->select(self::$table, "plate_id = :plate_id", $bind)[0];
    }

    /**
     * get plates entry link by zone id
     * @param int $zone_id
     * @return array
     */
    public static function getPlatesLinkByZoneId($zone_id) {
        self::initialize();
        $bind = array(
            ":zone_id" => $zone_id
        );
        $result = self::$db->select(self::$table, "zone_id = :zone_id", $bind);

        if($result) return array("link" => "?page=plates&action=edit&platesid=".$result[0]["plate_id"], "class" => "label-primary", "title" => "ouvrir");
        else return array("link" => "?page=plates&action=add&zoneid=".$zone_id, "class" => "label-success", "title" => "créer");
    }
}// END class