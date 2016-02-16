<?php
/**
 * Upload Hanlder class
 **/

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

//TODO exit script from here when no correct posts


class uploadHandler {

    /**
     * Upload directory
     * @var String
     * @access private
     */
    private $upload_dir;

    /**
     * Folder type
     * @var String
     * @access private
     */
    private $foldertype;

    /**
     * supported mimes
     * @var array
     * @access private
     */
    private $mimes;

    /**
     * Constructor function.
     */
    function __construct() {
        $this->upload_dir = "../uploads/";

        //Set folder type from post
        $this->foldertype = "SDFiles";

        switch($this->foldertype) {
            case "":break;
            case "":break;
            case "":break;
            case "":break;
            default:break;

        }

        //set supported mimes array
        $this->mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
    }

    /**
     * Upload file
     * @return JSON
     */
    function uploadFile() {

        if (isset($_FILES["myfile"])) {

            if ($_FILES["myfile"]["error"] > 0) {
                echo json_encode(array('status'=>'error','msg_error'=>$_FILES['file']['error']));
            } else {
                if(in_array($_FILES['myfile']['type'],$this->mimes)){

                    if(move_uploaded_file($_FILES["myfile"]["tmp_name"], $this->upload_dir . $_FILES["myfile"]["name"])) {

                        $content = file($this->upload_dir . $_FILES["myfile"]["name"]);
                        $csv = array_map('str_getcsv',$content,array_fill(0, count($content), $this->delemiter) );

                        if($this->createTableFromArray($csv,basename($this->upload_dir . $_FILES["myfile"]["name"], ".csv"))) {

                            echo json_encode(array('status'=>'success','array'=>$csv,'tablename'=>basename($this->upload_dir . $_FILES["myfile"]["name"], ".csv")));
                        }

                    }

                } else {
                    echo json_encode(array('status'=>'error','msg_error'=>'csv invalid'));
                }

            }
        }

    }
}// END class

$api = new uploadHandler();
$api->uploadFile();