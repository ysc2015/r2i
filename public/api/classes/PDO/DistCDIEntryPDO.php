<?php
/**
 * Dist CDI entry PDO class.
 * @author RR
 */

class DistCDIEntryPDO {

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
        self::$table = "distcdi";
        self::$entry_name = "distribution/commande CDI";
        //set upload directory
        self::$upload_dir = "../../uploads/fichiersprojets/";
    }

    /**
     * add dist cdi entry
     * @return bool
     */
    public static function insertDistCDIEntry($insert) {
        self::initialize();

        $date = new DateTime('now');
        $toinsert = $insert;
        $toinsert['createdAt'] = $date->format('Y-m-d H:i:s');

        $toinsert['but_ret_date'] = ($insert['but_ret_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['but_ret_date'])->format('Y-m-d'):null);
        $toinsert['ret_ter_date'] = ($insert['ret_ter_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['ret_ter_date'])->format('Y-m-d'):null);
        $toinsert['trans_date'] = ($insert['trans_date']!=""?DateTime::createFromFormat('d/m/Y', $insert['trans_date'])->format('Y-m-d'):null);

        $result = self::$db->insert(self::$table,$toinsert);
        if($result) {
            $lastInsertId = self::$db->lastInsertId();
            return array("done" =>true,"msg" =>"entréé ".self::$entry_name." crée pour le sous projet en cours.","id" => $lastInsertId);
        }
        else return array("done" =>false,"msg" =>"probléme enregistrement entrée ".self::$entry_name);
    }

    /**
     * update dist cdi entry
     * @param array $update
     * @return array
     */
    public static function updateDistCDIEntry($update) {
        self::initialize();
        $bind = array(
            ":distcdi_id" => $update['distcdi_id']
        );

        $date = new DateTime('now');
        $toupdate = $update;
        $toupdate['updatedAt'] = $date->format('Y-m-d H:i:s');

        $toupdate['but_ret_date'] = ($update['but_ret_date']!=""?DateTime::createFromFormat('d/m/Y', $update['but_ret_date'])->format('Y-m-d'):null);
        $toupdate['ret_ter_date'] = ($update['ret_ter_date']!=""?DateTime::createFromFormat('d/m/Y', $update['ret_ter_date'])->format('Y-m-d'):null);
        $toupdate['trans_date'] = ($update['trans_date']!=""?DateTime::createFromFormat('d/m/Y', $update['trans_date'])->format('Y-m-d'):null);

        try {
            $result = self::$db->update(self::$table, $toupdate, "distcdi_id = :distcdi_id", $bind);
            if($result) return array("done" =>true,"msg" =>"entréé ".self::$entry_name." mis à jour");
            else return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        } catch(Exception $e) {
            self::logIt($e->getMessage());
            return array("done" =>false,"msg" =>"probléme mise à jour entréé ".self::$entry_name);
        }

        //return array("done" =>false,"msg" =>$toupdate['auto_adduction_date']);
    }

    /**
     * get dist cdi entry by id
     * @param int $distcdi_id
     * @return array
     */
    public static function getDistCDIById($distcdi_id) {
        self::initialize();
        $bind = array(
            ":distcdi_id" => $distcdi_id
        );
        return self::$db->select(self::$table, "distcdi_id = :distcdi_id", $bind)[0];
    }
}// END class