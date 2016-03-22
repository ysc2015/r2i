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

    /**
     * Select room pics records to synchronize with mobile app
     * @param array $param (room_id)
     * @return array
     */
    public function getPicsToSynchronize($param) {
        $bind = array(
            ":room_id" => $param['rid'],
            ":flag" => 'yes'
        );
        //SQL
        $result = $this->db->select("rooms", "flag = :flag AND room_id = :room_id", $bind);/* AND user_id = :user_id*/
        return $result;
    }


}// END class