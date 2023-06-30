<?php
session_start();

// validation - checking number has the correct syntax
function is_an_invoice_syntax_OK(string $invoice_no) {
        $is_OK = true;        
        $invoice_no_parts = explode('/', $invoice_no);

        // // Nr musi składać się z 3 części
        if (count($invoice_no_parts) !== 3) {
                $is_OK = false;
        } 
        
        $count_num = $invoice_no_parts[0];
        $month = $invoice_no_parts[1];
        $year = $invoice_no_parts[2];

        // // COUNT NUM - Number created from any number of digits 
        if (mb_strlen(intval($count_num)) !== mb_strlen($count_num)) {
                $is_OK = false;
        };
        
        // // MONTH - number created from 2 digits between 1-12. If the number is 1-9 then add "0" on the left side
        $month_int = intval($month);
        if (($month_int < 1 || $month_int > 12) || ($month !== str_pad($month_int, 2, '0', STR_PAD_LEFT))) {
                $is_OK = false;
        }
        
        // // YEAR - number created from 4 digits
        if (mb_strlen(intval($year)) !== mb_strlen($year) || mb_strlen($year) !== 4) {
                $is_OK = false;
        }
        
        return $is_OK;
}

if (is_an_invoice_syntax_OK($_POST['invoice-no'])) {
        echo "Syntax is OK";
}