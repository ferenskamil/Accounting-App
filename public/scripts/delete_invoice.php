<?php
session_start();

$invoice_no_to_delete = $_POST['pop-up-invoice-no-hidden-input'];

// Get user data to $user assoc array
if (isset($_SESSION['user'])) $user = $_SESSION['user'];

require_once '../../config/database/db_database.php';

// Find invoice id
$db_invoice_id_query = $db->prepare("SELECT id FROM invoices
        WHERE user_id = :user_id AND no = :invoice_no");
$db_invoice_id_query->bindValue(':user_id', $user['id'] , PDO::PARAM_STR);
$db_invoice_id_query->bindValue(':invoice_no', $invoice_no_to_delete, PDO::PARAM_STR);
$db_invoice_id_query->execute();
$invoice_id = $db_invoice_id_query->fetch(PDO::FETCH_ASSOC);
$invoice_id = $invoice_id['id'];

// Delete invoice
$db_delete_invoice_query = $db->prepare("DELETE FROM invoices
        WHERE id = :id");
$db_delete_invoice_query->bindValue(':id', $invoice_id, PDO::PARAM_INT);
$db_delete_invoice_query->execute();

// Delete services
$db_delete_services_query = $db->prepare("DELETE FROM services
        WHERE invoice_id = :invoice_id");
$db_delete_services_query->bindValue(':invoice_id', $invoice_id, PDO::PARAM_INT);
$db_delete_services_query->execute();

// Create comment message
$_SESSION['comment_after_delete'] = "Invoice No. <span>".$invoice_no_to_delete."</span> has been successfully deleted.";

header('Location: ../list.php');

?>