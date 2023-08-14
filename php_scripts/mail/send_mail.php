<?php
/*
PHPMailer manual - https://github.com/PHPMailer/PHPMailer
*/
// - - - - - - - - - 
// IMPORT PHPMAILER 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../assets/PHPMailer/src/Exception.php';
require '../../assets/PHPMailer/src/PHPMailer.php';
require '../../assets/PHPMailer/src/SMTP.php';

// - - - - - - - - - 
// TEMPLATE - PREPARE FOR SENDING EMAIL

/*
Basic variables for future use. If you need more variables you can create it here.
Set the less frequently changed usages below.
 */
$smtp_username = 'testowedev123@gmail.com';
$smtp_password = 'rhayhozrhthmtckg';

$sender_mail = 'testowedev123@gmail.com';
$sender_name = 'Accounting App';
$recipient_mail = 'mr.kaam@gmail.com';
$recipient_name = 'Kamil Ferens';  
$reply_to_mail = $sender_mail;
$reply_to_name = 'Customer Service | Accounting App';


$subject = 'This is the subject';
$body_html = <<<HTML
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mail Message</title>
        <style>
            .bold {
                font-weight: 700;
                text-decoration: underline;
            }

        </style>


    </head>

    <body>
        <h1 class="bold">Hello World Again</h1>
        
        <script src="test.js"></script>
    </body>

</html>
HTML;
$body_alt = 'This is the body in plain text for non-HTML mail clients';



// - - - - - - - - - 
// SEND MAIL
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
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
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;           // only for develop          
        $mail->isSMTP();                                            
        $mail->Port       = 465;    
        $mail->Host       = 'smtp.gmail.com';       
        $mail->SMTPAuth   = true;                                   
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        
        $mail->Username   = $smtp_username;              
        $mail->Password   = $smtp_password;                     

        /*
        RECIPIENTS
        ->setFrom('email', 'name');     - from whom will the message come
        ->addAddress('email', 'name');  - who will get the message (name is optional)
        >addReplyTo('email', 'name')    - to whom should come possible answer (name is optional)
        ->addCC('email);                - (optional) - add CC recipient 
        ->addBCC('email');              - (optional) - add BCC recipient 

        more about CC and BCC: https://dhosting.pl/pomoc/baza-wiedzy/czym-rozni-sie-cc-od-bcc-podczas-wysylania-wiadomosci-e-mail/     */
        $mail->setFrom($sender_mail , $sender_name);
        $mail->addAddress($recipient_mail , $recipient_name);
        $mail->addReplyTo($reply_to_mail , $recipient_name);   
        $mail->addBCC($sender_mail);   

        /*
        ATTACHMENTS
        ->addAttachment('path', 'filename')     - add attachment (filename is optional) */
        // [code space]

        /*
        CONTENT
        ->isHTML(true);         - inform that we will want to send email as html
        ->Charset               - set charset
        ->Subject               - message subject
        ->Body                  - message body (html)
        ->AltBody               - message body in plain text (for non-HTML mail clients) 
        
        or:
        ->msgHTML('path')       - attach external html file
        */
        $mail->isHTML(true);                                 
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $body_html;
        $mail->AltBody = $body_alt;
        

        /*
        SEND MESSAGE
        Send email after configuration */
        $mail->send();

        /*
        Confirmation after successful mailing */
        echo '<strong>Message has been sent</strong>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>