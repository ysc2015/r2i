<?php
/**
 * Room model class
 */


class Room {
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
     * Excel limit for injection
     * @var excelLimitCfg array
     * @access private
     */
    private $excelCfg;

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
        $this->upload_dir = "../../uploads/";

        //set allowed mimes types for download
        $this->mimes = array("application/vnd.ms-excel","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

        //Excel limit for inject
        $this->excelCfg = array(
            "highestColumn" => 'G'
        );
    }

    /**
     * Select all rooms files from DB
     * @return array
     */
    public function getAllRoomsFiles() {
        //build sql query
        $sql ="SELECT rooms_file_id,injected_filename,saved_filename,injection_date ";
        $sql .="FROM rooms_files ";
        $sql .="ORDER BY rooms_files.rooms_file_id ASC";

        //run & retun sql result(array)
        return $this->db->run($sql);
    }

    /**
     * Add a room
     * @param array $insert values
     * @return array|bool|int
     */
    public function insertRoom($insert) {
        return $this->db->insert("rooms", $insert);
    }

    /**
     * Inject Rooms file
     * @return array
     */
    public function injectRoomsFile() {
        //
        if (isset($_FILES["myfile"])) {

            if ($_FILES["myfile"]["error"] > 0) {
                return(array('done' => false, 'msg' => "ce fichier ne peux étre sauvegardé sur le serveur !"));
            } else {
                if(in_array($_FILES['myfile']['type'],$this->mimes)){

                    try {
                        if(move_uploaded_file($_FILES["myfile"]["tmp_name"], $this->upload_dir . $_FILES["myfile"]["name"])) {

                            //  Read your Excel workbook
                            try {
                                $inputFileType = PHPExcel_IOFactory::identify($this->upload_dir . $_FILES["myfile"]["name"]);
                                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                                $objPHPExcel = $objReader->load($this->upload_dir . $_FILES["myfile"]["name"]);
                            } catch(Exception $e) {
                                die('Error loading file "'.pathinfo($this->upload_dir . $_FILES["myfile"]["name"],PATHINFO_BASENAME).'": '.$e->getMessage());
                                return(array('done' => false, 'msg' => "erreur de lecture du fichier excel !"));
                            }

                            //  Get worksheet dimensions
                            $sheet = $objPHPExcel->getSheet(0);

                            $row = 2;

                            $ret = array();
                            $rowData = array();
                            $rowData[0][0] = "1";
                            //  Loop through each row of the worksheet in turn
                            while($rowData[0][0] != "") {
                                $rowData = $sheet->rangeToArray('A' . $row . ':' . $this->excelCfg['highestColumn'] . $row,"",TRUE,FALSE);
                                if($rowData[0][0] != "") {
                                    //used for log & dev  test
                                    array_push($ret,$rowData[0]);
                                }

                                $row++;
                            }
                            $row = 1;
                            foreach($ret as $key=>$value) {
                                //inject values SQL
                                $insert = array(
                                    "injected_filename" => $_FILES["myfile"]["name"],
                                    "REF_CHAMBR" => $value[0],
                                    "VILLET" => $value[1],
                                    "SOUS_PROJET" => $value[2],
                                    "REF_NOTE" => $value[3],
                                    "CODE_CH1" => $value[4],
                                    "CODE_CH2" => $value[5],
                                    "GPS" => $value[6],
                                    "flag" => ""
                                );

                                //  DB insert
                                try {
                                    $result = $this->insertRoom($insert);
                                    if(!$result)
                                        return(array('done' => false, 'msg' => "insertion stopée à la ligne ".$row." du fichier excel !"));
                                } catch(Exception $e) {
                                    return(array('done' => false, 'msg' => "erreur injection serveur !"));
                                }

                                $row++;
                            }
                            return(array('done' => true, 'msg' => "le fichier ".$_FILES["myfile"]["name"]." a été injecté avec succés !", "ret" => $ret));

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