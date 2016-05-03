<?php
/**
 * User PDO class.
 * @author RR
 */

class UserPDO {

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
        self::$table = "users";
        //set upload directory
        self::$upload_dir = "../uploads/users/";
    }

    /**
     * get all user
     * @return array
     */
    public static function getAllUsers() {
        self::initialize();

        //build sql query
        $sql ="SELECT u.*,p.profil_abbrev FROM ".self::$table." as u ";
        $sql .="INNER JOIN profils as p on u.profil_id = p.profil_id ";
        $sql .="WHERE p.profil_id != 1 ";//exclude root users
        $sql .="ORDER BY u.user_id DESC";

        //echo $sql;

        $result = self::$db->run($sql);

        if($result) return array("done" => true,"msg" => "utilisateurs récupérés", "data" => $result);
        else return array("done" =>false,"msg" =>"probléme récupération utilisateurs", "data" => []);
    }

    /**
     * get user by email
     * @param string $email
     * @return a
     */
    public static function getUserByEmail($email) {
        self::initialize();

        $bind = array(
            ":email" => $email
        );
        $result = self::$db->select(self::$table, "email = :email", $bind);
        return (!empty($result)?$result[0]:false);
    }

    /**
     * add user
     * @param array $insert
     * @return array
     */
    public static function insertUser($insert) {
        self::initialize();

        $date = new DateTime('now');
        $toinsert = $insert;
        $toinsert['createdAt'] = $date->format('Y-m-d H:i:s');

        $result = self::$db->insert(self::$table,$toinsert);
        if($result) return array("done" =>true,"msg" =>"utilisateur enregistré");
        else return array("done" =>false,"msg" =>"probléme enregistrement utilisateur");
    }

    /**
     * get user by id
     * @param int $user_id
     * @return array
     */
    public static function getUserById($user_id) {
        self::initialize();

        $bind = array(
            ":user_id" => $user_id
        );
        $result = self::$db->select(self::$table, "user_id = :user_id", $bind);
        return (!empty($result)?$result[0]:false);

    }

    /**
     * get users by profil id
     * @param int $profil_id
     * @return array
     */
    public static function getUsersByProfilId($profil_id) {
        self::initialize();

        /*$bind = array(
            ":profil_id" => $profil_id
        );*/
        return self::$db->select(self::$table);

    }

    /**
     * delete user by id
     * @param array $delete
     * @return array
     */
    public static function deleteUser($delete) {
        self::initialize();

        $bind = array(
            ":user_id" => $delete['user_id']
        );
        $result = self::$db->delete(self::$table,"user_id = :user_id", $bind);
        if($result) {
            return array("done" => true,"msg" => "utilisateur supprimé");
        }
        else return array("done" =>false,"msg" =>"probléme suppression utilisateur");
    }

    /**
     * update user
     * @param array $update
     * @return array
     */
    public static function updateUser($update) {
        self::initialize();

        $bind = array(
            ":user_id" => $update['user_id']
        );

        $date = new DateTime('now');
        $toupdate = $update;
        $toupdate['updatedAt'] = $date->format('Y-m-d H:i:s');

        $result = self::$db->update(self::$table, $toupdate, "user_id = :user_id", $bind);
        if($result) return array("done" =>true,"msg" =>"utilisateur mis à jour");
        else return array("done" =>false,"msg" =>"probléme mise à jour utilisateur");
    }

    /**
     * check if email exists used in remote validation
     * @param string $email
     * @return string
     */
    public static function emailExists($email) {
        self::initialize();

        $bind = array(
            ":email" => $email
        );
        $result = self::$db->select(self::$table, "email = :email", $bind);
        return (!empty($result)?'false':'true');
    }
}// END class