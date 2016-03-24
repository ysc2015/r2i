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
     * Allowed mimes types
     * @var mimes array
     * @access private
     */
    private $mimes;

    /**
     * Upload directory
     * @var String
     * @access private
     */
    private $upload_dir;

    /**
     * Constructor function.
     */
    public function __construct() {
        //load database instance to $db member variable
        $this->db = DB::getInstance();

        //set upload directory
        $this->upload_dir = "../uploads/photoschambres/";

        //set allowed mimes types for download
        $this->mimes = array("application/vnd.ms-excel","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
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

    /**
     * Inject Room pic file
     * @return array
     */
    public function injectRoomPic() {

        //
        if (isset($_FILES["myfile"])) {

            if ($_FILES["myfile"]["error"] > 0) {
                return(array('done' => false, 'msg' => "ce fichier ne peux étre sauvegardé sur le serveur !"));
            } else {
                if(/*in_array($_FILES['myfile']['type'],$this->mimes)*/true){

                    try {
                        if(move_uploaded_file($_FILES["myfile"]["tmp_name"], $this->upload_dir . $_FILES["myfile"]["name"])) {

                            //  DB insert
                            $insert = array(
                                "tab_room_pic_id" => $_POST['tab_room_pic_id'],
                                "room_id" => $_POST['room_id'],
                                "latitude" => $_POST['latitude'],
                                "longitude" => $_POST['longitude'],
                                "altitude" => $_POST['altitude'],
                                "accuracy" => $_POST['accuracy'],
                                "altitudeAccuracy" => $_POST['altitudeAccuracy'],
                                "heading" => $_POST['heading'],
                                "speed" => $_POST['speed'],
                                "timestamp" => $_POST['timestamp'],
                                "imageFilename" => $_POST['imageFilename'],
                                "imageDesc" => $_POST['imageDesc'],
                                "imageTitle" => $_POST['imageTitle'],
                                "imageSrvURL" => $_FILES["myfile"]["name"],
                                "flag" => ""
                            );
                            try {
                                $result = $this->insertPicture($insert);
                                if(!$result)
                                    return(array('done' => false, 'msg' => "insertion error !"));
                                else return(array('done' => true, 'msg' => "photo enregistrée !"));
                            } catch(Exception $e) {
                                return(array('done' => false, 'msg' => "erreur insertion image !"));
                            }

                        }else
                            return(array('done' => false, 'msg' => "le fichier n'a pas été enregistré sur le serveur !"));
                    } catch (Exception $e) {
                        return(array('done' => false, 'msg' => "le fichier n'a pas été traité sur le serveur !"));
                    }

                } else {
                    return(array('done' => false, 'msg' => "le format de fichier n'est pas autorisé !"));
                }

            }
        } else
            return(array('done' => false, 'msg' => "aucun fichier uploadé, veuillez séléctionner un fichier excel pour injection !"));
    }


}// END class