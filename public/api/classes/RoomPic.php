<?php
/**
 * RoomPic model class
 */

class RoomPic {
    /**
     * Database Instance
     * @var PDO object
     * @access private
     */
    private $db;

    /**
     * Constructor function.
     */
    public function __construct() {
        //load database instance to $db member variable
        $this->db = DB::getInstance();
    }

    /**
     * Add a room picture
     * @param array $insert values
     * @return array|bool|int
     */
    public function insertPicture($insert) {
        return $result = $this->db->insert("room_pics", $insert);
    }


}// END class