<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//require 'vendor/phpmailer/PHPMailer/src/Exception.php';
//require 'vendor/phpmailer/PHPMailer/src/PHPMailer.php';
//require 'vendor/phpmailer/PHPMailer/src/SMTP.php';

require 'vendor/autoload.php';

//require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';

/**
 * This library handles all the notification email deliveries
 * on the system.
 *
 * Custom system settings for the notification section are loaded
 * during the execution of each class methods.
 *
 * @package Libraries
 */
class Notifications{
        
    private $ci;

    /**
     * Class Constructor
     */
    public function __construct() {
        //$this->ci =& get_instance();
    }
        
    /**
     * Replace the email template variables.
     *
     * This method finds and replaces the html variables of an email
     * template. It is used to generate dynamic HTML emails that are
     * send as notifications to the system users.
     *
     * @param array $replace_array Array that contains the variables
     * to be replaced.
     * @param string $email_html The email template hmtl.
     * @return string Returns the new email html that contain the
     * variables of the $replace_array.
     */
     private function replace_template_variables($replace_array, $email_html) {
        foreach($replace_array as $var=>$value) {
            $email_html = str_replace($var, $value, $email_html);
        }

        return $email_html;
    }
        
    public function send_mail($to, $from, $subject, $cc, $bcc, $replyTo, $attachments, $tpl, $body, $replace_array){
        
        if($tpl != '')
        {
            $email_html = file_get_contents(dirname(dirname(__FILE__))
                    . '/views/emails/'. $tpl .'.php');
            $email_html = $this->replace_template_variables($replace_array, $email_html); 
        }
        else
        {
            $email_html = $body;
        }
        
        // :: SETUP EMAIL OBJECT AND SEND NOTIFICATION
        $mail = new PHPMailer();
		
		//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'email-smtp.us-east-1.amazonaws.com';  // Specify main and backup SMTP servers
		//$mail->Host = 'smtp.mailgun.org';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'AKIATWGU4XT7FQGDRPQ5';                 // SMTP username
		//$mail->Username = 'dacco@mg.ascendwds.com';                 // SMTP username
		$mail->Password = 'BNwdl3bjjQFSL8dtAiPLw5EAEj2tHIkHwpvd9I8xDnRl';                           // SMTP password
		//$mail->Password = 'a87246f844f04eb0434685a8a2230779-29561299-cdbb6028';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to		
		
        $mail->From = $from;
        $mail->FromName = 'Cove Behavioral Health Reporting App';
        
        for($i = 0; $i < count($to); $i++)
        {
            $mail->AddAddress($to[$i]); // "Name" argument crushes the phpmailer class.
        }
        
        for($i = 0; $i < count($cc); $i++)
        {
            $mail->addCC($cc[$i]);
        }
        
        for($i = 0; $i < count($bcc); $i++)
        {
            $mail->addBCC($bcc[$i]); 
        }
        
        for($i = 0; $i < count($attachments); $i++)
        {
            $mail->addAttachment($attachments[$i]); 
        }
        
        if($replyTo != '')
            $mail->addReplyTo($replyTo);
        
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body = $email_html;

        if (!$mail->Send()) {
            throw new Exception('Email could not be sent.'
                    . 'Mailer Error (Line ' . __LINE__ . '): ' . $mail->ErrorInfo);
        }

        return TRUE;
        
    }
	
    }
?>