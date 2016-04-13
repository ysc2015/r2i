<?php
/**
 * MailNotifier class.
 * @author RR
 */

require_once 'lib/PHPMailer/PHPMailerAutoload.php';


class MailNotifier extends Model {

    /**
     * Mail Instance
     * @var PHPMailer object
     * @access private
     */
    private static $mail;

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
        //instanciate PHPMailer object
        //SMTP needs accurate times, and the PHP time zone MUST be set
        //This should be done in your php.ini, but this is how to do it if you don't have access to that
        date_default_timezone_set('Etc/UTC');

        //Create a new PHPMailer instance
        self::$mail = new PHPMailer;

        //Tell PHPMailer to use SMTP
        self::$mail->isSMTP();

        //Set charset
        self::$mail->CharSet = 'UTF-8';

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        self::$mail->SMTPDebug = 0;

        //Ask for HTML-friendly debug output
        self::$mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        self::$mail->Host = 'smtp.gmail.com';

        //Set who the message is to be sent from
        self::$mail->setFrom('r2ibackoffice@gmail.com', 'Contact R2I');
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        self::$mail->Port = 587;

        //Set the encryption system to use - ssl (deprecated) or tls
        self::$mail->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        self::$mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        self::$mail->Username = "r2ibackoffice@gmail.com";

        //Password to use for SMTP authentication
        self::$mail->Password = "r2ib@ck0ffice";
    }

    public static function sendMailNotification($messagetype,$ressourceid) {
        self::initialize();

        $subject = "";
        $html = "";
        $to = array();
        switch($messagetype) {
            case "project_create" : self::$upload_dir = "../../uploads/fichiersprojets/";
                                    $project = ProjectPDO::getProjectById($ressourceid);
                                    $subject = "Lancement Projet d’étude Plaque PON FTTH [".$project["site_code"]."] [".$project["city"]."]";
                                    $to []= array("bitlord1980@gmail.com");
                                    $html .= '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
                                    $html .='<html>';
                                    $html .='<head>';
                                    $html .='<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
                                    $html .='<title>'.$subject.'</title>';
                                    $html .='</head>';
                                    $html .='<body>';
                                    $html .='<div style="width: 640px;float: left;text-align: left">';
                                    $html .='<h1>Infos création projet :</h1>';
                                    $html .='<h5>Ville : '.$project["city"].'</h5>';
                                    $html .='<h5>Trigramme de la plaque + Dept : '.$project["plate_dept_code"].'</h5>';
                                    $html .='<h5>Code site d’origine : '.$project["site_code"].'</h5>';
                                    $html .='<h5>Type de Site d’origine : '.$project["type_site_id"].'</h5>';
                                    $html .='<h5>Taille approximative en LR : '.$project["size"].'</h5>';
                                    $html .='<h5>Etat Site Origine : '.$project["orig_site_state_id"].'</h5>';
                                    $html .='<h5>Date Mise à disposition site Origine : '.$project["orig_site_provision_date"].'</h5>';
                                    $html .='</div>';
                                    $html .='</body>';
                                    $html .='</html>';
                                    break;
            default :break;
        }
        //send mail
        /*foreach($to as $key => $value) {
            //Set who the message is to be sent to
            self::$mail->addAddress($value);
        }*/

        self::$mail->addAddress("bitlord1980@gmail.com");

        //Set attachement
        $files = SDFilePDO::getProjectFilesByProjectId($ressourceid);
        if($files["done"]) {
            foreach($files["data"] as $key => $value) {
                if(file_exists(self::$upload_dir.$value["uploaded_filename"]))
                    self::$mail->addAttachment(self::$upload_dir.$value["uploaded_filename"]);
            }
        }
        //Set the subject line
        self::$mail->Subject = $subject;

        self::$mail->msgHTML($html, dirname(__FILE__));

        //send the message, check for errors
        if (!self::$mail->send()) {
            return array("done" =>false,"msg" => self::$mail->ErrorInfo);
        } else {
            return array("done" =>true,"msg" => "création de projet validé, un message a été envoyé aux destinataires.");
        }
    }

}// END class
