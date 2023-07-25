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
} else {
        $_SESSION['e_invoice_no_syntax'] = 'The number must follow the formula "number/month/year" for example "1/01/1111"';
        header('Location: ../invoice_edit.php');
        exit();
}

// Prepare services for entry into the database 
if (isset($_POST['position'])) {       
        $positions = array_values($_POST['position']);
        $service_names = array_values($_POST['service_name']);
        $service_codes = array_values($_POST['service_code']);
        $quantities = array_values($_POST['quantity']);
        $item_net_prices = array_values($_POST['item_net_price']);
        $service_taxes = array_values($_POST['service_tax']);
        $service_total_nets = array_values($_POST['service_total_net']);
        $service_total_grosses = array_values($_POST['service_total_gross']);
        
        $services_arr = [];
        for ($i=0; $i < count($positions); $i++ ) {
                $service = []; 
                $service['position'] = floatval($positions[$i]);
                $service['service_name'] = $service_names[$i];
                $service['service_code'] = $service_codes[$i];
                $service['quantity'] = floatval($quantities[$i]);
                $service['item_net_price'] =  number_format(floatval($item_net_prices[$i]), 2, '.', ' ');
                $service['service_tax'] = $service_taxes[$i];
                $service['service_total_net'] =  number_format(floatval($service_total_nets[$i]), 2, '.', ' ');
                $service['service_total_gross'] =  number_format(floatval($service_total_grosses[$i]), 2, '.', ' ');

                $services_arr[$i] = $service;
        }

        print_r($services_arr[0]);
}
// connect with database
require_once 'db_database.php';

////////////////////////////////
// ADD OR EDIT INVOICE IN DATABASE 
// Checking if there is already an invoice in the database with the given number (for a given user)
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

// Add or edit invoice in database 
if (isset($_SESSION['is_user_wants_edit']) && $_SESSION['is_user_wants_edit'] === true) {
        $query = $db->prepare("UPDATE invoices
                SET
                        `date` = :date,
                        sum_net = :sum_net,
                        sum_gross = :sum_gross,
                        city = :city,
                        bank = :bank, 
                        account_no = :account_no,
                        payment_term = :term,
                        to_pay = :to_pay_numeric,
                        to_pay_in_words = :to_pay_verbal,
                        additional_notes = :comment,
                        seller_name = :seller_name,
                        seller_address1 = :seller_address1,
                        seller_address2 = :seller_address2,
                        seller_company_no = :seller_company_no, 
                        customer_name = :customer_name,
                        customer_address1 = :customer_address1,
                        customer_address2 = :customer_address2,
                        customer_company_no = :customer_company_no
                WHERE
                        user_id = :id AND no = :invoice_no");
        $query->bindvalue(':date', $_POST['date'], PDO::PARAM_STR);
        $query->bindvalue(':sum_net', $_POST['total-net'], PDO::PARAM_STR);
        $query->bindvalue(':sum_gross', $_POST['total-gross'], PDO::PARAM_STR);
        $query->bindvalue(':city', $_POST['city'], PDO::PARAM_STR);
        $query->bindvalue(':bank', $_POST['bank'], PDO::PARAM_STR);
        $query->bindvalue(':account_no', $_POST['account-no'], PDO::PARAM_STR);
        $query->bindvalue(':term', $_POST['term'], PDO::PARAM_STR);
        $query->bindvalue(':to_pay_numeric',$_POST['to-pay-numeric'], PDO::PARAM_STR);
        $query->bindvalue(':to_pay_verbal',$_POST['to-pay-verbal'], PDO::PARAM_STR);
        $query->bindvalue(':comment', $_POST['comment'], PDO::PARAM_STR);
        $query->bindvalue(':seller_name', $_POST['seller-name'], PDO::PARAM_STR);
        $query->bindvalue(':seller_address1', $_POST['seller-address1'], PDO::PARAM_STR);
        $query->bindvalue(':seller_address2', $_POST['seller-address2'], PDO::PARAM_STR);
        $query->bindvalue(':seller_company_no', $_POST['seller-company-no'], PDO::PARAM_STR);
        $query->bindvalue(':customer_name', $_POST['customer-name'], PDO::PARAM_STR);
        $query->bindvalue(':customer_address1', $_POST['customer-address1'], PDO::PARAM_STR);
        $query->bindvalue(':customer_address2', $_POST['customer-address2'], PDO::PARAM_STR);
        $query->bindvalue(':customer_company_no', $_POST['customer-company-no'], PDO::PARAM_STR);
        $query->bindvalue(':id', $_SESSION['id'], PDO::PARAM_INT);
        $query->bindvalue(':invoice_no', $_POST['invoice-no'], PDO::PARAM_STR);
        $query->execute();

        $_SESSION['invoice_no_to_display'] = $_POST['invoice-no'];
        $_SESSION['comment_after_edit'] = "Invoice No. <span>".$_SESSION['invoice_no_to_display']."</span> has been successfully amended ";
        unset($_SESSION['invoice_no_to_edit']);
        unset($_SESSION['is_user_wants_edit']);
} elseif (!in_array($_POST['invoice-no'], $invoice_nums)) {
        $query = $db->prepare("INSERT INTO invoices (`user_id`, `no`, `date`, 
        `sum_net`, `sum_gross`, `city`, `bank`, 
        `account_no`, `payment_term`, 
        `to_pay`, `to_pay_in_words`, 
        `additional_notes`, `customer_name`, `customer_address1`, 
        `customer_address2`, `customer_company_no`, `seller_name`, `seller_address1`, 
        `seller_address2`, `seller_company_no`) 
        VALUES (:user_id, :no , :date,
        :sum_net, :sum_gross ,:city, :bank,
        :account_no , :term,
        :to_pay, :to_pay_in_words,
        :comment, :customer_name, :customer_address1,
        :customer_address2, :customer_company_no, 
        :seller_name, :seller_address1,
        :seller_address2, :seller_company_no)");
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
        $query->bindvalue(':seller_name', $_POST['seller-name'], PDO::PARAM_STR);
        $query->bindvalue(':seller_address1', $_POST['seller-address1'], PDO::PARAM_STR);
        $query->bindvalue(':seller_address2', $_POST['seller-address2'], PDO::PARAM_STR);
        $query->bindvalue(':seller_company_no', $_POST['seller-company-no'], PDO::PARAM_STR);
        $query->execute();

        $_SESSION['invoice_no_to_display'] = $_POST['invoice-no'];
        $_SESSION['comment_after_edit'] = "Invoice No. <span>".$_SESSION['invoice_no_to_display']."</span> has been successfully added";
} else {
        $_SESSION['comment_after_edit'] = "Coś poszło nie tak. Nie można dodać nr faktury, bo taki już istnieje. Nie można edytować obecnego nr bo użytkonik nie zgadza się na edycję.";
}
////////////////////////////////
// UPDATE SERVICES IN DATABASE
// prepare invoice id
$db_invoice_id_query = $db->prepare("SELECT id FROM invoices
        WHERE no = :invoice_no AND user_id = :user_id");

$db_invoice_id_query->bindValue(':invoice_no',$_POST['invoice-no'], PDO::PARAM_STR);
$db_invoice_id_query->bindValue(':user_id',$_SESSION['id'], PDO::PARAM_INT);
$db_invoice_id_query->execute();
$invoice_id = $db_invoice_id_query->fetch();
$invoice_id = $invoice_id['id'];

// Remove services from database 
$db_remove_services_query = $db->prepare("DELETE FROM services
WHERE user_id = :user_id AND invoice_id = :invoice_id");
$db_remove_services_query->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
$db_remove_services_query->bindValue(':invoice_id', $invoice_id, PDO::PARAM_INT);
$db_remove_services_query->execute();

// Add services to database 
if (isset($services_arr)){
        foreach($services_arr as $service) {
                $db_add_service_query = $db->prepare("INSERT INTO `services`(
                        `user_id`,
                        `invoice_id`,
                        `position`,
                        `service_name`,
                        `service_code`,
                        `quantity`,
                        `item_net_price`,
                        `service_tax`,
                        `service_total_net`,
                        `service_total_gross`
                )
                VALUES(
                        :user_id,
                        :invoice_id,
                        :position,
                        :service_name,
                        :service_code,
                        :quantity,
                        :item_net_price,
                        :service_tax,
                        :service_total_net,
                        :service_total_gross
                )");
                $db_add_service_query->bindvalue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
                $db_add_service_query->bindvalue(':invoice_id', $invoice_id, PDO::PARAM_INT);
                $db_add_service_query->bindvalue(':position', $service['position'], PDO::PARAM_INT);
                $db_add_service_query->bindvalue(':service_name', $service['service_name'], PDO::PARAM_STR);
                $db_add_service_query->bindvalue(':service_code', $service['service_code'], PDO::PARAM_STR);
                $db_add_service_query->bindvalue(':quantity', $service['quantity'], PDO::PARAM_INT);
                $db_add_service_query->bindvalue(':item_net_price', $service['item_net_price'], PDO::PARAM_INT);
                $db_add_service_query->bindvalue(':service_tax', $service['service_tax'], PDO::PARAM_INT);
                $db_add_service_query->bindvalue(':service_total_net', $service['service_total_net'], PDO::PARAM_INT);
                $db_add_service_query->bindvalue(':service_total_gross', $service['service_total_gross'], PDO::PARAM_INT);
                $db_add_service_query->execute();
        }
}
////////////////////////////////
// Redirect to preview
header('Location: ../invoice_preview.php');
?>