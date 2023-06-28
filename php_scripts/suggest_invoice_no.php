<?php
// function to propose a new invoice number 
function suggest_invoice_no(int $num = 0) {
        $month = date('m');
        $year = date('Y');
        $num++;

        return "$num/$month/$year";
};

// Connect database
require_once './php_scripts/db_database.php';

$db_invoices_nums = $db->prepare("
        SELECT invoices.no FROM `invoices`
        INNER JOIN users ON invoices.user_id = users.id
        WHERE users.login = :login");
$db_invoices_nums->bindvalue(':login', $_SESSION['login'], PDO::PARAM_STR);
$db_invoices_nums->execute();
$db_invoices_nums_arr = $db_invoices_nums->fetchAll(PDO::FETCH_ASSOC);

// Sort the invoice numbers of a given user
if (!empty($db_invoices_nums_arr)) {
        foreach ($db_invoices_nums_arr as $invoice_row) {
                $invoice_numbers[] = $invoice_row['no'];

        }

        foreach($invoice_numbers as $num) {
                $invoice_numbers_exploded[] = explode('/', $num);
        }

        usort($invoice_numbers_exploded, function($a, $b) {
                if ($b[2] !== $a[2]) {
                        return $b[2] - $a[2];
                } else  if ($b[1] !== $a[1]) {
                        return $b[1] - $a[1];
                } else {
                        return $b[0] - $a[0];
                }                       
        });       

        $latest_invoice_no_num = $invoice_numbers_exploded[0][0];
        $latest_invoice_no_month = $invoice_numbers_exploded[0][1];
        $latest_invoice_no_year = $invoice_numbers_exploded[0][2];
}

if ($db_invoices_nums->rowCount() === 0) {
        $_SESSION['suggestion_invoice_no'] = suggest_invoice_no();
} else {

        if($latest_invoice_no_month >= date('m') && $latest_invoice_no_year >= date('Y')){
                $_SESSION['suggestion_invoice_no'] = suggest_invoice_no($latest_invoice_no_num);    
        } else {     
                $_SESSION['suggestion_invoice_no'] = suggest_invoice_no();
        }
        
        // validation - the number must be unique
        while (in_array($_SESSION['suggestion_invoice_no'], $invoice_numbers )) {
                $validate_no = $_SESSION['suggestion_invoice_no'];
                $validate_no = explode('/', $validate_no);
                $_SESSION['suggestion_invoice_no'] = suggest_invoice_no($validate_no[0]);
        } 
}