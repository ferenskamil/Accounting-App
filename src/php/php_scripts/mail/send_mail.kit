<?php
// - - - - - - - - - 
// DOWNLOAD INVOICE DATA
session_start();

require_once '../redirect_if_user_not_logged_in.php';
redirect_if_user_not_logged_in('index.php');

// Set a variable to include the recipient's email. 
// This email will be displayed in the input in case the script execution fails.  
$_SESSION['recipient_email_input_content'] = $_POST['recipient_mail'];

// Get user data to $user assoc array
if (isset($_SESSION['user'])) $user = $_SESSION['user'];

// Exit the script if the user did not submit the form
if (!isset($_POST['invoice_no_to_send'])) {
        $_SESSION['comment_download_error'] = "Something went wrong, the invoice was not found. Try again in a while. ";
        header('Location: ../invoice_list.php');
        exit();
}

// If invoice id was found...
// connect with database
require_once '../db_database.php';

// Dowload invoice data from database to array
$db_query = $db->prepare("SELECT * FROM invoices WHERE user_id = :user_id AND no = :invoice_no");
$db_query->bindvalue(':user_id', $user['id'], PDO::PARAM_STR);
$db_query->bindvalue(':invoice_no', $_POST['invoice_no_to_send'], PDO::PARAM_STR);
$db_query->execute();
$invoice = $db_query->fetch(PDO::FETCH_ASSOC);

// Download services from database to array
$db_services_query = $db->prepare("SELECT * FROM services WHERE user_id = :user_id AND invoice_id = :invoice_id");
$db_services_query->bindvalue(':user_id', $user['id'], PDO::PARAM_INT);
$db_services_query->bindvalue(':invoice_id', $invoice['id'], PDO::PARAM_INT);
$db_services_query->execute();
$services_arr = $db_services_query->fetchAll(PDO::FETCH_ASSOC);

// Some variables that will be inserted into html code
foreach ($services_arr as $service) {
        if ($service['service_tax'] === '0.00') {
                $service_tax = "tax-free";
        } else {
                $service_tax = strval($service['service_tax']*100)."%";
        }
        $service_tr = "
        <tr>
                <td>{$service['position']}</td>
                <td>{$service['service_name']}</td>
                <td>{$service['service_code']}</td>
                <td>{$service['quantity']}</td>
                <td>".number_format($service['item_net_price'], 2, ',',' ')."</td>
                <td>{$service_tax}</td>
                <td>".number_format($service['service_total_net'], 2, ',',' ')." $</td>
                <td>".number_format($service['service_total_gross'], 2, ',',' ')." $</td>
        </tr>";

        // Create $all_services_tr if it is first iteration
        if (!isset($all_services_tr)) $all_services_tr = '';

        // Conacate created $service_tr to $all_services_tr
        $all_services_tr .= $service_tr;
}
$to_pay_numeric = number_format($invoice['to_pay'], 2, ',',' ');
$to_pay_verbal = $invoice['to_pay_in_words'];

$total_sum_net = number_format($invoice['sum_net'], 2, ',',' ');
$total_sum_gross = number_format($invoice['sum_gross'], 2, ',',' ');

// - - - - - - - - - 
// DOWLOAD DOMPDF LIBRARY

// include autoloader
require_once '../../assets/dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$tmp = sys_get_temp_dir();

$dompdf = new Dompdf([
        'logOutputFile' => '',
        // authorize DomPdf to download fonts and other Internet assets
        'isRemoteEnabled' => true,
        // all directories must exist and not end with /
        'fontDir' => $tmp,
        'fontCache' => $tmp,
        'tempDir' => $tmp,
        'chroot' => $tmp,
    ]);

// - - - - - - - - - 
// PREPARE TO GENERATE PDF

// add image path
$logo_img_path = "../../assets/img/logos/{$user['logo']}";
$dompdf->getOptions()->setChroot("$logo_img_path");

$html = <<<HTML
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            *,
            *::before,
            *::after {
            	box-sizing: border-box;
            	margin: 0;
            	padding: 0;
            }

            body {
                font-family: DejaVu Sans;
            }

            .pdf {
		        padding: 35px;
                padding-top: 26px;
            }

            .row {
                display: inline-block;
                position: relative;
                margin: 0 auto;
                padding: 0;
                width: 100%;
            }

            .col {
                position: relative;
                display: inline-block;
                width: 347px;
            }

            .col-p {
                margin-left: 20px;
            }

            /* Row 1 */ 
            .row1 {
                display: inline-block;
                margin-top: 14px;
                height: 150px; 
            }

            .logo {
            }

            .logo img {
                display: inline-block;
                position: relative;
                left: 0;
                top: 0;
                max-width: 150px;
            }

            .invoice-info {
                position: absolute;
                top: 0;
                right: 0;
                float: right;
                height: 100%;
            }

            .invoice-info p{
                font-size: 11px;
            }

            /* Row 2 */
            .row2 {
                margin-top: 10px;
            }

            .title {
                font-size: 20px;
            }
            /* Row 3 */
            .row3 {
                margin-top: 32px;
            }

            .details {
                font-size: 11px;
            }

            .details h3 {
                font-size: 18px;
            }

            /* Row 4  */
            .row4 {

            }

            .table {
                width: 100%;
                border-collapse: collapse;
                font-size: 11px;
            }

            .table thead {
                border: 1px solid black;
            }

            .table thead tr {
                border: 1px solid black;
            }

            .table thead tr th {
                padding: 7px 9px;
            }

            .table tbody {
                border: 1px solid black;
            }

            .table tbody tr {
                border: none;
            } 

            .table tbody tr td {
                padding: 7px 9px;
                text-align: center;
            }

            .table tfoot {

            }

            .table tfoot tr td {
                padding: 7px 9px;
                font-weight: 700;
		        text-align: center;
            }
            /* Row 5 */
            .row5 {
                margin-top: 10px;
            }

            .row5 p {
                font-size: 11px;
            }

            /* Row 6 */
            .row6 {
                position: relative;
                display: inline-block;
                margin-top: 15px;
                min-height: 40px;
                height: auto;
            }

            .notes {
            }

            .notes h3 {
                font-size: 18px;
            }

            .notes .comment {
                font-family: inherit;
                font-size: 11px;
                white-space: pre-wrap;
            }

            .notes .footnote {
                font-size: 8px;
            }
            /* row7 */
            .row7 {
                position: relative;
                display: inline-block;
                margin-top: 10px;
                height: auto;
            }

            .notes2 {
                border-top: 1px solid black;
            }

            .notes2 .footnote {
                font-size: 8px;
            }

            .sign {
                float: right;
                height: auto;
                border-top: 1px solid black;
            }

            .sign p {
                font-size: 8px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="pdf">
                <div class="row1 row">
                        <div class="logo col">
                                <img src="{$logo_img_path}" alt="company logo">
                        </div>
                        <div class="invoice-info col col-p">
                                <p><b>Invoice date: </b>{$invoice['date']}</p>
                                <p><b>City: </b>{$invoice['city']}</p>
                                <p><b>Bank: </b>{$invoice['bank']}</p>
                                <p><b>Account no.: </b>{$invoice['account_no']}</p>
                                <p><b>Payment term: </b>{$invoice['payment_term']}</p>
                        </div>
                </div>
                <div class="row2 row">
                        <h2 class="title">Invoice no. {$invoice['no']}</h2>
                </div>
                <div class="row3 row">
                        <div class="details col">
                                <h3>Seller:</h3>
                                <p>{$invoice['seller_name']}</p>
                                <p>{$invoice['seller_address1']}</p>
                                <p>{$invoice['seller_address2']}</p>
                                <p>NIP: {$invoice['seller_company_no']}</p>
                        </div>
                        <div class="details col col-p">
                                <h3>Bill to:</h3>
                                <p>{$invoice['customer_name']}</p>
                                <p>{$invoice['customer_address1']}</p>
                                <p>{$invoice['customer_address2']}</p>
                                <p>NIP: {$invoice['customer_company_no']}</p>
                        </div>
                </div>
                <div class="row4 row">
                        <table class="table">
                                <thead>
                                        <tr>
                                                <th>No.</th>
                                                <th>Item / service</th>
                                                <th>Service code</th>
                                                <th>Quantity</th>
                                                <th>Net price</th>
                                                <th>Tax</th>
                                                <th>Net sum</th>
                                                <th>Gross sum</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        {$all_services_tr}
                                </tbody>
                                <tfoot>
                                        <tr>
                                                <td colspan="4"></td>
                                                <td>TOTAL:</td>
                                                <td></td>
                                                <td>{$total_sum_net} $</td>
                                                <td>{$total_sum_gross} $</td>
                                        </tr>
                                </tfoot>
                        </table>
                </div>
                <div class="row5 row">
                        <p><b>To pay: </b>{$to_pay_numeric} $</p>
                        <p><b>In words: </b>{$to_pay_verbal}</p>
                </div>
                <div class="row6 row">            
                        <div class="notes col">
                                <h3>Additional notes</h3>
                                <pre class="comment">{$invoice['additional_notes']}</pre>
                        </div>
                </div>
                <div class="row7 row">
                        <div class="notes2 col">
                                <p class="footnote">*Fill in if the following   applies to the good (service).example, subject    exemptions     from tax.</p>
                        </div>
                        <div class="sign col col-p">
                                <p>Signature of authorized person</p>
                        </div>
                </div>
        </div>
    </body>
</html>
HTML;

// - - - - - - - - - 
// GENERATE PDF

// Pass html code to $dompdf object
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$filename = $user['login'] . "_".str_replace('/', '_', $invoice['no']) . ".pdf";
$target_path = '../../assets/pdf_files/' . $filename;
file_put_contents($target_path, $dompdf->output());


/*
Part above is to render PDF 
Part below is to send and email. 
*/
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

// Get user data to $user assoc array
// session_start();
if (isset($_SESSION['user'])) $user = $_SESSION['user'];

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
$recipient_mail = $_POST['recipient_mail'];
$recipient_name = '';  
$reply_to_mail = 'testowedev123@gmail.com';
$reply_to_name = 'Customer Service | Accounting App';

$subject = 'New Invoice | Accounting App';
$body_html = <<<HTML
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mail Message</title>
        
    </head>

    <body>
        <main>
                <div class="content" " style="width: 100%;max-width: 480px;margin: 0 auto;color: #000000;">
                    <div class=" content__message" style="padding: 10px;">
                        <img src="cid:logoimg" alt="logo" style="height: 50px; margin: 10px 0">
                        <h1 style="margin-top: 0">Hello!</h1>
                        <p>User <b>{$user['company']}</b> has just issued you an invoice No. <b>{$_POST['invoice_no_to_send']}</b> for its
                                services.</p>
                        <p>Pay it according to the deadline or contact the <b>{$user['company']}</b> for clarification.
                        </p>
                        <p>An invoice is attached to this message as pdf file.</p>
                </div>
                <div class="content__footer" style="padding: 10px;background-color: #f7f7f7;">
                        <p style="margin: 0;font-size: 11px;color: #88898c;">This message was sent to <span class="recipient__mail" style="text-decoration: underline;color: #003147;">{$recipient_mail}</span>. If you have
                                questions or complaints, please <b>contact us</b>.</p>
                        <br>
                        <p style="margin: 0;font-size: 11px;color: #88898c;">Accounting App, Poland. Thank you for using!</p>
                </div>
                </div>
        </main>
    </body>

</html>
HTML;
$body_alt = "Hello!\r\n\r\n

    User" . $user['company'] . "has just issued you an invoice No. " . $_POST['invoice_no_to_send'] . " for its services.\r\n
    Pay it according to the deadline or contact the" . $user['company'] . "for clarification. \r\n\r\n

    An invoice should be attached to this message as pdf file.\r\n
    If the invoice is not attached to this email, please contact us and we will solve the problem as soon as possible. We apologize for the complication. \r\n\r\n

    This message was sent to" . $recipient_mail . ". If it's not you, please ignore it and report it to us.\r\n\r\n 

    Accounting App, Poland. Thank you for using!";

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
        $mail->addAttachment('../../assets/pdf_files/' . $filename);
        $mail->addEmbeddedImage('../../assets/img/logos/default_logo.png', 'logoimg'); // opisz jak to działa
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
        Delete pdf file from server */
        unlink('../../assets/pdf_files/' . $filename);

        /*
        Confirmation after successful mailing */
        $_SESSION['comment_after_email'] = "Invoice No. <b>" . $_POST['invoice_no_to_send'] . "</b> has been successfylly sent to <b>" . $user['company'] ."</b>.";
        $_SESSION['invoice_no_to_display'] = $_POST['invoice_no_to_send'];

        /*
        Delete recipient email input content after successful sending email*/
        unset($_SESSION['recipient_email_input_content']);

        /*
        Redirect to app*/
        Header('Location: ../../invoice_preview.php');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>