<?php
// - - - - - - - - -
// DOWNLOAD INVOICE DATA
session_start();

require_once '../../public/scripts/redirect_if_user_not_logged_in.php';
redirect_if_user_not_logged_in('index.php');


// Check the conditions for running the script
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
if ((strpos($referer, 'public/preview.php') !== false)
        && $_SERVER["REQUEST_METHOD"] === "POST"
        && isset($_POST['invoice_no_to_send']))
{
    // Set a variable to include the recipient's email.
    // This email will be displayed in the input in case the script execution fails.
    $_SESSION['recipient_email_input_content'] = $_POST['recipient_mail'];

    // Get user data to $user assoc array
    if (isset($_SESSION['user'])) $user = $_SESSION['user'];
    if (isset($_SESSION['invoice'])) $invoice = $_SESSION['invoice'];

    try {
        // Prepare all information about email to  send
        require_once '../../config/phpmailer/prepare_email_details.php';
        $email_details = prepare_email_details(
            'testowedev123@gmail.com',              // smtp_username
            'rhayhozrhthmtckg',                     // smtp_password
            'testowedev123@gmail.com',              // sender_mail
            'Accounting App',                       // sender_name
            $_POST['recipient_mail'],               // recipient_mail
            '',                                     // recipient_name
            'testowedev123@gmail.com',              // reply_to_mail
            'Customer Service | Accounting App',    // reply_to_name
            'New Invoice | Accounting App'          // subject
        );

        // Send email
        require_once '../../config/phpmailer/send_invoice_in_email.php';
        send_invoice_in_email($user , $invoice , $email_details);

        // Confirmation after successful mailing
        $_SESSION['comment_after_email'] = "Invoice No. <b>" . $_POST['invoice_no_to_send'] . "</b> has been successfylly sent to <b>" . $user['company'] ."</b>.";

        // Delete recipient email input content after successful sending email
        unset($_SESSION['recipient_email_input_content']);

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $_SESSION['e_send'] = 'Something has gone wrong! Try sending the message again.';
    }

    /*
    Prepare invoice no. for redirection to invoice_preview.php file */
    $_SESSION['invoice_no_to_display'] = $_POST['invoice_no_to_send'];

    /*
    Redirect to app*/
    Header('Location: ../../public/preview.php');
    exit();
}
else
{
    $_SESSION['comment_download_error'] = "Something went wrong, the invoice was not found. Try again in a while. ";
    header('Location: ../list.php');
    exit();
}
?>


