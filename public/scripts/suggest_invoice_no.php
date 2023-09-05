<?php
// function to propose a new invoice number
function suggest_invoice_no(int $num = 0) {
        $month = date('m');
        $year = date('Y');
        $num++;

        return "$num/$month/$year";
};

// Get user data to $user assoc array
if (isset($_SESSION['user'])) $user = $_SESSION['user'];

// Get info about invoices from DB
require_once '../class/user.class.php';
$user_obj = new User();
$invoices = $user_obj->get_all_invoices($user['id']);

// Assign invoice numbers to $invoice_nums array
$invoice_nums = [];
foreach ($invoices as $invoice) $invoice_nums[] = $invoice['no'];

// Sort the invoice numbers of a given user
if (!empty($invoice_nums)) {
        foreach($invoice_nums as $num) {
                $invoice_nums_exploded[] = explode('/', $num);
        }

        usort($invoice_nums_exploded, function($a, $b) {
                if ($b[2] !== $a[2]) {
                        return $b[2] - $a[2];
                } else  if ($b[1] !== $a[1]) {
                        return $b[1] - $a[1];
                } else {
                        return $b[0] - $a[0];
                }
        });

        $latest_invoice_no_num = $invoice_nums_exploded[0][0];
        $latest_invoice_no_month = $invoice_nums_exploded[0][1];
        $latest_invoice_no_year = $invoice_nums_exploded[0][2];
}

if (empty($invoice_nums)) {
        $_SESSION['suggestion_invoice_no'] = suggest_invoice_no();
} else {

        if($latest_invoice_no_month >= date('m') && $latest_invoice_no_year >= date('Y')){
                $_SESSION['suggestion_invoice_no'] = suggest_invoice_no($latest_invoice_no_num);
        } else {
                $_SESSION['suggestion_invoice_no'] = suggest_invoice_no();
        }

        // validation - the number must be unique
        while (in_array($_SESSION['suggestion_invoice_no'], $invoice_nums )) {
                $validate_no = $_SESSION['suggestion_invoice_no'];
                $validate_no = explode('/', $validate_no);
                $_SESSION['suggestion_invoice_no'] = suggest_invoice_no($validate_no[0]);
        }
}