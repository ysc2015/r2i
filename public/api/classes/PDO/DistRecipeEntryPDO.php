<?php
/**
 * Dist Recipe entry PDO class.
 * @author RR
 */

class DistRecipeEntryPDO {

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
        self::$table = "distrecipe";
        self::$entry_name = "distribution/recette";
        //set upload directory
        self::$upload_dir = "../../uploads/fichiersprojets/";
    }

    /**
     * add dist recipe entry
     * @return bool
     */
    public static function insertDistRecipeEntry($insert) {
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
     * update dist recipe entry
     * @param array $update
     * @return array
     */
    public static function updateDistRecipeEntry($update) {
        self::initialize();
        $bind = array(
            ":distrecipe_id" => $update['distrecipe_id']
        );

        $date = new DateTime('now');
        $toupdate = $update;
        $toupdate['updatedat'] = $date->format('Y-m-d H:i:s');

        $toupdate['recipe_date'] = ($update['recipe_date']!=""?DateTime::createFromFormat('d/m/Y', $update['recipe_date'])->format('Y-m-d'):null);

        try {
            $result = self::$db->update(self::$table, $toupdate, "distrecipe_id = :distrecipe_id", $bind);
            if($result) return array("done" =>true,"msg" =>"entréé ".self::$entry_name." mis à jour");
            else return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        } catch(Exception $e) {
            self::logIt($e->getMessage());
            return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        }

        //return array("done" =>false,"msg" =>$toupdate['auto_adduction_date']);
    }

    /**
     * get dist recipe entry by id
     * @param int $distrecipe_id
     * @return array
     */
    public static function getDistRecipeById($distrecipe_id) {
        self::initialize();
        $bind = array(
            ":distrecipe_id" => $distrecipe_id
        );
        return self::$db->select(self::$table, "distrecipe_id = :distrecipe_id", $bind)[0];
    }
}// END class