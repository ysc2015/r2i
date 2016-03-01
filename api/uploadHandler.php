<?php
/**
 * Upload Hanlder class
 **/

require_once 'autoLoader.php';


class uploadHandler {

    /**
     * Send raw HTTP response
     * @param int $status HTTP status code
     * @param string $body The body of the HTTP response
     * @param string $contentType Header content-type
     * @return HTTP response
     */
    private function sendResponse($status = 200, $body = '', $contentType = 'application/json')
    {
        // Set the status
        $statusHeader = 'HTTP/1.1 ' . $status . ' ' . $this->getStatusCodeMessage($status);
        header($statusHeader);
        // Set the content type
        header('Content-type: ' . $contentType);

        echo $body;
    }

    /**
     * Return the http status message based on integer status code
     * @param int $status HTTP status code
     * @return string status message
     */

    private function getStatusCodeMessage($status)
    {
        $codes = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

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
    function __construct($fileType) {
        //set upload directory
        $this->upload_dir = "../uploads/";

        //Set folder type from post
        //$this->foldertype = "SDFiles";

        //set supported mimes array
        switch($fileType) {
            case "image":$this->mimes = array('image/jpeg');
                break;
            case "excel":$this->mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
                break;
            default:$this->mimes = array();break;

        }
    }

    /**
     * Upload file
     * @return JSON
     */

    function uploadFile() {

        if (isset($_FILES["myfile"])) {

            if ($_FILES["myfile"]["error"] > 0) {
                $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>$_FILES['file']['error'])));
            } else {
                if(in_array($_FILES['myfile']['type'],$this->mimes)){

                    $insert = array(
                        //"room_pic_id" => $_POST['room_pic_id'],
                        "room_id" => $_POST['room_id'],
                        "latitude" => $_POST['latitude'],
                        "longitude" => $_POST['longitude'],
                        "altitude" => $_POST['altitude'],
                        "accuracy" => $_POST['accuracy'],
                        "altitudeAccuracy" => $_POST['altitudeAccuracy'],
                        "heading" => $_POST['heading'],
                        "speed" => $_POST['speed'],
                        "timestamp" => $_POST['timestamp'],
                        "imageTabURI" => $_POST['imageTabURI'],
                        "imageSrvURL" => "",
                        "flag" => ""
                    );

                    $roomPic = new RoomPic();

                    if($roomPic->insertPicture($insert)) {
                        if(move_uploaded_file($_FILES["myfile"]["tmp_name"], $this->upload_dir . $_FILES["myfile"]["name"])) {

                            //$content = file($this->upload_dir . $_FILES["myfile"]["name"]);
                            $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'file transfered')));
                        } else $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'file not transfered')));
                    }
                    else
                        $this->sendResponse(200,json_encode(array('status'=>'success','msg'=>'invalid file infos')));

                } else {
                    $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'invalid file type')));
                }

            }
        }

    }
}// END class

if(isset($_POST['filetype'])) {
    $api = new uploadHandler($_POST['filetype']);
    $api->uploadFile($_POST['filetype']);
} else $this->sendResponse(200,json_encode(array('status'=>'error','msg'=>'file type not specified')));
