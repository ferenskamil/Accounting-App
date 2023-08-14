<?php
/*
PHPMailer manual - https://github.com/PHPMailer/PHPMailer
*/

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../assets/PHPMailer/src/Exception.php';
require '../../assets/PHPMailer/src/PHPMailer.php';
require '../../assets/PHPMailer/src/SMTP.php';

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
        
        $mail->Username   = 'testowedev123@gmail.com';              
        $mail->Password   = 'rhayhozrhthmtckg';                     

        /*
        RECIPIENTS
        ->setFrom('email', 'name');     - from whom will the message come
        ->addAddress('email', 'name');  - who will get the message (name is optional)
        >addReplyTo('email', 'name')    - to whom should come possible answer (name is optional)
        ->addCC('email);                - (optional) - add CC recipient 
        ->addBCC('email');              - (optional) - add BCC recipient 

        more about CC and BCC: https://dhosting.pl/pomoc/baza-wiedzy/czym-rozni-sie-cc-od-bcc-podczas-wysylania-wiadomosci-e-mail/     */
        $mail->setFrom('testowedev123@gmail.com', 'Accounting App');
        $mail->addAddress('mr.kaam@gmail.com', 'Kamil Ferens');
        $mail->addReplyTo('testowedev123@gmail.com', 'Customer Service | Accounting App');   
        $mail->addBCC('testowedev123@gmail.com');   

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
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        

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