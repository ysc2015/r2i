<?php
/**
 * Transport Switch entry PDO class.
 * @author RR
 */

class TransportRecipeEntryPDO {

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
        self::$table = "transportrecipe";
        self::$entry_name = "transport/recette";
        //set upload directory
        self::$upload_dir = "../../uploads/fichiersprojets/";
    }

    /**
     * add transport recipe entry
     * @return bool
     */
    public static function insertTransportRecipeEntry($insert) {
        self::initialize();

        $date = new DateTime('now');
        $toinsert = $insert;
        $toinsert['createdAt'] = $date->format('Y-m-d H:i:s');

        $toinsert['recipe_date'] = ($insert['recipe_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['recipe_date'])->format('Y-m-d'):null);

        $result = self::$db->insert(self::$table,$toinsert);
        if($result) {
            $lastInsertId = self::$db->lastInsertId();
            return array("done" =>true,"msg" =>"entréé ".self::$entry_name." crée pour le sous projet en cours.","id" => $lastInsertId);
        }
        else return array("done" =>false,"msg" =>"probléme enregistrement entrée ".self::$entry_name);
    }

    /**
     * update transport recipe entry
     * @param array $update
     * @return array
     */
    public static function updateTransportRecipeEntry($update) {
        self::initialize();
        $bind = array(
            ":transportrecipe_id" => $update['transportrecipe_id']
        );

        $date = new DateTime('now');
        $toupdate = $update;
        $toupdate['updatedAt'] = $date->format('Y-m-d H:i:s');

        $toupdate['recipe_date'] = ($update['recipe_date']!=""?DateTime::createFromFormat('d/m/Y', $update['recipe_date'])->format('Y-m-d'):null);

        try {
            $result = self::$db->update(self::$table, $toupdate, "transportrecipe_id = :transportrecipe_id", $bind);
            if($result) return array("done" =>true,"msg" =>"entréé ".self::$entry_name." mis à jour");
            else return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        } catch(Exception $e) {
            self::logIt($e->getMessage());
            return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        }

        //return array("done" =>false,"msg" =>$toupdate['auto_adduction_date']);
    }

    /**
     * get transport recipe entry by id
     * @param int $transportrecipe_id
     * @return array
     */
    public static function getTransportRecipeById($transportrecipe_id) {
        self::initialize();
        $bind = array(
            ":transportrecipe_id" => $transportrecipe_id
        );
        return self::$db->select(self::$table, "transportrecipe_id = :transportrecipe_id", $bind)[0];
    }

    /**
     * get transport recipe entry link by zone id
     * @param int $zone_id
     * @return array
     */
    public static function getTransportRecipeLinkByZoneId($zone_id) {
        self::initialize();
        $bind = array(
            ":zone_id" => $zone_id
        );
        $result = self::$db->select(self::$table, "zone_id = :zone_id", $bind);

        if($result) return array("link" => "?page=transportrecipe&action=edit&transportrecipeid=".$result[0]["transportrecipe_id"], "class" => "label-primary", "title" => "ouvrir");
        else return array("link" => "?page=transportrecipe&action=add&zoneid=".$zone_id, "class" => "label-success", "title" => "créer");
    }
}// END class