<?php
/**
 * mail api class
 **/

require_once 'lib/PHPMailer/PHPMailerAutoload.php';

class mailApi {

    private $arrOfParams;

    // Constructor function
    function __construct() {
        //parent::__construct();
        //init array of parameters
        $this->arrOfParams = array();
    }

    // process api method
    function processApi($method="") {

        if(isset($_POST['parameters'])) {
            $parameters = json_decode($_POST['parameters'],true);
            array_push($this->arrOfParams,$parameters);
            call_user_func_array(array($this,$method),$this->arrOfParams);
        } else call_user_func(array($this,$method));
    }

    //requested methods here

    /**
     * Api methods
     */

    /**
     * Send mail
     * @return JSON
     */
    private function send_mail() {
        //SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
        date_default_timezone_set('Etc/UTC');

//Create a new PHPMailer instance
        $mail = new PHPMailer;

//Tell PHPMailer to use SMTP
        $mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
        $mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

//Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
        $mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "bitlord1980@gmail.com";

//Password to use for SMTP authentication
        $mail->Password = "w@r!nc@s@";

//Set who the message is to be sent from
        $mail->setFrom('bitlord1980@gmail.com', 'First Last');

//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to
        $mail->addAddress('bitlord1980@gmail.com');
        $mail->addAddress('rrahmouni@rc2k.fr');

//Set the subject line
        $mail->Subject = 'PHPMailer GMail SMTP test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
        $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
        $mail->addAttachment('images/testss.tar.gz');

//send the message, check for errors
        if (!$mail->send()) {
            //echo "Mailer Error: " . $mail->ErrorInfo;
            return true;
        } else {
            //echo "Message sent!";
            return false;
        }
    }

}// END class

$api = new mailApi();
if(isset($_POST['method']) && $_POST['method']!="") {
    sleep(1);//test loader
    $api->processApi($_POST['method']);
}

else echo json_encode(array('status'=>'error','msg'=>'erreur traitement serveur !'));
