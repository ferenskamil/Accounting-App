<?php
// - - - - - - - - -
// DOWNLOAD INVOICE DATA
session_start();

require_once '../../public/scripts/redirect_if_user_not_logged_in.php';
redirect_if_user_not_logged_in('index.php');

// Check the conditions for running the script
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
if ((strpos($referer, 'public/list.php') !== false || strpos($referer, 'public/preview.php') !== false)
        && $_SERVER["REQUEST_METHOD"] === "POST")
{
        // Get user data to $user assoc array
        if (isset($_SESSION['user'])) $user = $_SESSION['user'];

        // Get invoice information
        require_once '../../class/invoice.class.php';
        $invoice_obj = new Invoice($_POST['invoice-no'], $user['id']);
        $invoice = $invoice_obj->get_invoice();

        // Render pdf
        require_once '../../config/dompdf/render_invoice_pdf.php';
        render_invoice_pdf($user, $invoice);
}
else
{
        $_SESSION['comment_download_error'] = "Something went wrong, the invoice was not found. Try again in a while. ";
        header('Location: ../../public/list.php');
        exit();
}




