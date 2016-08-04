<?php
/**
 * file: mail.notifier.class.php
 * User: rabii
 */

require_once __DIR__.'/phpMailer/class.phpmailer.php';
require_once __DIR__.'/phpMailer/class.smtp.php';

class MailNotifier {

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

        self::$upload_dir = __DIR__.'/../api/uploads/';

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

    public static function sendMail($subject,$html,$to,$files) {
        self::initialize();

        $to[] = "bitlord1980@gmail.com";

        foreach($to as $adresse) {
            self::$mail->addAddress($adresse);
        }

        //Set attachement
        foreach($files as $file) {
            if(file_exists(self::$upload_dir.$file['dossier']."/".$file['nom_fichier_disque']))
                self::$mail->addAttachment(self::$upload_dir.$file['dossier']."/".$file['nom_fichier_disque']);
        }
        //Set the subject line
        self::$mail->Subject = $subject;

        self::$mail->msgHTML($html, dirname(__FILE__));

        return self::$mail->send();
    }

}// END class