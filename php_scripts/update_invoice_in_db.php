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
        unset($_SESSION['e_invoice_no_syntax']);
        echo "Syntax is OK";
} else {
        $_SESSION['e_invoice_no_syntax'] = 'The number must follow the formula "number/month/year" for example "1/01/1111"';
        header('Location: ../invoice.php');
        exit();
}

// Checking if there is already an invoice in the database with the given number (for a given user)
require_once 'db_database.php';

$db_invoices_query = $db->prepare("
        SELECT invoices.no FROM `invoices`
        INNER JOIN users ON invoices.user_id = users.id
        WHERE users.login = :login");
$db_invoices_query->bindvalue(':login', $_SESSION['login'], PDO::PARAM_STR);
$db_invoices_query->execute();
$db_invoices_nums = $db_invoices_query->fetchAll(PDO::FETCH_ASSOC);

foreach($db_invoices_nums as $num) {
        $invoice_nums[] = $num['no'];
}

if (in_array($_POST['invoice-no'], $invoice_nums)) {
        header('Location: ./add_invoice_to_db_confirmation.php');
} else {
        $query = $db->prepare("INSERT INTO invoices (`user_id`, `no`, `date`, 
        `sum_net`, `sum_gross`, `city`, `bank`, 
        `account_no`, `payment_term`, 
        `to_pay`, `to_pay_in_words`, 
        `additional_notes`, `customer_name`, `customer_address1`, 
        `customer_address2`, `customer_company_no`) 
        VALUES (:user_id, :no , :date,
        :sum_net, :sum_gross ,:city, :bank,
        :account_no , :term,
        :to_pay, :to_pay_in_words,
        :comment, :customer_name, :customer_address1,
        :customer_address2, :customer_company_no)");
        $query->bindvalue(':user_id', $_SESSION['id'], PDO::PARAM_STR);
        $query->bindvalue(':no', $_POST['invoice-no'], PDO::PARAM_STR);
        $query->bindvalue(':date', $_POST['date'], PDO::PARAM_STR);
        $query->bindvalue(':sum_net', $_POST['total-net'], PDO::PARAM_STR);
        $query->bindvalue(':sum_gross', $_POST['total-gross'], PDO::PARAM_STR);
        $query->bindvalue(':city', $_POST['city'], PDO::PARAM_STR);
        $query->bindvalue(':bank', $_POST['bank'], PDO::PARAM_STR);
        $query->bindvalue(':account_no', $_POST['account-no'], PDO::PARAM_STR);
        $query->bindvalue(':term', $_POST['term'], PDO::PARAM_STR);
        $query->bindvalue(':to_pay',$_POST['to-pay-numeric'], PDO::PARAM_STR);
        $query->bindvalue(':to_pay_in_words',$_POST['to-pay-verbal'], PDO::PARAM_STR);
        $query->bindvalue(':comment', $_POST['comment'], PDO::PARAM_STR);
        $query->bindvalue(':customer_name', $_POST['customer-name'], PDO::PARAM_STR);
        $query->bindvalue(':customer_address1', $_POST['customer-address1'], PDO::PARAM_STR);
        $query->bindvalue(':customer_address2', $_POST['customer-address2'], PDO::PARAM_STR);
        $query->bindvalue(':customer_company_no', $_POST['customer-company-no'], PDO::PARAM_STR);
        $query->execute();
        header('Location: ../invoice.php');

        // Trzeba jeszcze dorobić kolumny do tabeli BILLED TO 
}


?>