<?php


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Start Composer's autoload
require __DIR__ . '/../../vendor/autoload.php';

/* This function create instance of PHPMailer class with initial
 * settings for future use. */
function generate_phpmailer(array $email_details) : object
{
        $phpmailer = new PHPMailer(true);

        /*
        SERVER SETTINGS
        ->SMTPDebug = SMTP::DEBUG_SERVER;     - Enable verbose debug output
        ->isSMTP();         - inform that you will be using SMTP
        ->Port;             - set port  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        ->Host;             - set SMTP server address
        ->SMTPAuth;         - inform that you will want to authenticate to the SMTP server
        ->SMTPSecure;       - inform that you will be using SMTP encryption
        ->Username          - username to log in to SMTP server
        ->Password          - SMTP code needed to log in to the smtp server */
        // $phpmailer->SMTPDebug = SMTP::DEBUG_SERVER;           // only for develop

        $phpmailer->isSMTP();
        $phpmailer->Port       = 465;
        $phpmailer->Host       = 'smtp.gmail.com';
        $phpmailer->SMTPAuth   = true;
        $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        $phpmailer->Username   = $email_details['smtp_username'];
        $phpmailer->Password   = $email_details['smtp_password'];

        /*
        RECIPIENTS
        ->setFrom('email', 'name');     - from whom will the message come
        ->addAddress('email', 'name');  - who will get the message (name is optional)
        >addReplyTo('email', 'name')    - to whom should come possible answer (name is optional)
        ->addCC('email);                - (optional) - add CC recipient
        ->addBCC('email');              - (optional) - add BCC recipient

        more about CC and BCC: https://dhosting.pl/pomoc/baza-wiedzy/czym-rozni-sie-cc-od-bcc-podczas-wysylania-wiadomosci-e-mail/ */
        $phpmailer->setFrom($email_details['sender_mail'] , $email_details['sender_name']);
        $phpmailer->addAddress($email_details['recipient_mail'] , $email_details['recipient_name']);
        $phpmailer->addReplyTo($email_details['reply_to_mail'] , $email_details['reply_to_name']);
        $phpmailer->addBCC($email_details['sender_mail']);
        // $subject = 'New Invoice | Accounting App'; // DO USUNIECIA

        // Return object with initial settings
        return $phpmailer;
}
?>