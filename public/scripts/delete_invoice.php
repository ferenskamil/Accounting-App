<?php
session_start();

// Check if the user tried to delete the invoice. The data should be passed from the 'list.php' or 'preview.php' page using the 'POST' method.
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
if ((strpos($referer, 'public/list.php') !== false || 
        strpos($referer, 'public/preview.php') !== false ) &&
        $_SERVER["REQUEST_METHOD"] === "POST")
{
        // Get user data to $user assoc array
        if (isset($_SESSION['user'])) $user = $_SESSION['user'];

        // Get invoice number to delete
        $invoice_no_to_delete = $_POST['pop-up-invoice-no-hidden-input'];

        // Create an instance of the Invoice class.
        require_once '../../class/invoice.class.php';
        $invoice_obj = new Invoice($invoice_no_to_delete , $user['id']);

        // Delete invoice
        $invoice_obj->delete_invoice();

        // Create comment message
        $_SESSION['comment_after_delete'] = "Invoice No. <span>".$invoice_no_to_delete."</span> has been successfully deleted.";
}

// Redirect to page with invoice list
header('Location: ../list.php');
?>