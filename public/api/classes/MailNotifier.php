<?php
/**
 * MailNotifier class.
 * @author RR
 */

class MailNotifier extends Model {

    /**
     * Mail Instance
     * @var PHPMailer object
     * @access private
     */
    private static $mail;

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
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        self::$mail->SMTPDebug = 0;
        //Ask for HTML-friendly debug output
        self::$mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        self::$mail->Host = "callnart.com";
        //Set the SMTP port number - likely to be 25, 465 or 587
        self::$mail->Port = 25;
        //Whether to use SMTP authentication
        self::$mail->SMTPAuth = true;
        //Username to use for SMTP authentication
        self::$mail->Username = "contact-site@callnart.com";
        //Password to use for SMTP authentication
        self::$mail->Password = "Hyjs5@72";
        //Set who the message is to be sent from
        self::$mail->setFrom('contact-site@callnart.com', 'callnart.com');
    }

    public static function sendMailNotification($messagetype,$ressourceid) {
        self::initialize();

        $subject = "";
        $html = "";
        $to = array();
        switch($messagetype) {
            case "project_create" : $project = ProjectPDO::getProjectById($ressourceid);
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
                                    $html .='<h5>Ville :</h5>';
                                    $html .='<p>'.$project["city"].'</p>';
                                    $html .='<h5>Trigramme de la plaque + Dept :</h5>';
                                    $html .='<p>'.$project["plate_dept_code"].'</p>';
                                    $html .='<h5>Code site d’origine :</h5>';
                                    $html .='<p>'.$project["site_code"].'</p>';
                                    $html .='<h5>Type de Site d’origine :</h5>';
                                    $html .='<p>'.$project["type_site_id"].'</p>';
                                    $html .='<h5>Taille approximative en LR :</h5>';
                                    $html .='<p>'.$project["size"].'</p>';
                                    $html .='<h5>Etat Site Origine :</h5>';
                                    $html .='<p>'.$project["orig_site_state_id"].'</p>';
                                    $html .='<h5>Date Mise à disposition site Origine :</h5>';
                                    $html .='<p>'.$project["orig_site_provision_date"].'</p>';
                                    $html .='</div>';
                                    $html .='</body>';
                                    $html .='</html>';
                                    break;
            default :break;
        }
        //send mail
        foreach($to as $key => $value) {
            //Set who the message is to be sent to
            self::$mail->addAddress($value);
        }
        //Set the subject line
        self::$mail->Subject = $subject;

        self::$mail->msgHTML($html, dirname(__FILE__));
    }

}// END class
