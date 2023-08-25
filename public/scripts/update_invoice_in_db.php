<?php
session_start();

// Get user data to $user assoc array
if (isset($_SESSION['user'])) $user = $_SESSION['user'];

// validation - checking number has the correct syntax
function is_an_invoice_syntax_OK(string $invoice_no) {
        $is_OK = true;        
        $invoice_no_parts = explode('/', $invoice_no);

        // Number must consist of 3 parts 
        if (count($invoice_no_parts) !== 3) {
                $is_OK = false;
        } 
        
        $count_num = $invoice_no_parts[0];
        $month = $invoice_no_parts[1];
        $year = $invoice_no_parts[2];

        // COUNT NUM - Number created from any number of digits 
        if (mb_strlen(intval($count_num)) !== mb_strlen($count_num)) {
                $is_OK = false;
        };
        
        // MONTH - number created from 2 digits between 1-12. If the number is 1-9 then add "0" on the left side
        $month_int = intval($month);
        if (($month_int < 1 || $month_int > 12) || ($month !== str_pad($month_int, 2, '0', STR_PAD_LEFT))) {
                $is_OK = false;
        }
        
        // YEAR - number created from 4 digits
        if (mb_strlen(intval($year)) !== mb_strlen($year) || mb_strlen($year) !== 4) {
                $is_OK = false;
        }
        
        return $is_OK;
}

print_r($_POST['user-wants-edit']);

function prepare_string_to_save_as_number(string $value, string $currency = 'PLN') {
        $value = str_replace(' ','',$value);
        $value = rtrim($value, $currency);
        $value = str_replace(',','.',$value);
        $value = floatval($value);
        return $value;
}

if (is_an_invoice_syntax_OK($_POST['invoice-no'])) {
        unset($_SESSION['e_invoice_no_syntax']);
} else {
        $_SESSION['e_invoice_no_syntax'] = 'The number must follow the formula "number/month/year" for example "1/01/1111"';
        header('Location: ../invoice_edit.php');
        exit();
}

// Check if the user tried to add or update the invoice. The data should be passed from the 'add_edit_form.php' page using the 'POST' method.
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
if (strpos($referer, 'public/add_edit_form.php') !== false  &&
        $_SERVER["REQUEST_METHOD"] === "POST")
{
        // Create an instance of the Invoice class.
        require_once '../../class/invoice.class.php';
        $invoice_obj = new Invoice($_POST['invoice-no'] , $user['id']);

        // Get an invoice from the DB. If the invoice does not exist, the get_invoice() method will return an empty [] array.
        $invoice = $invoice_obj->get_invoice();

        // Assign the information passed by the POST method to the appropriate keys
        $invoice['no'] = $_POST['invoice-no']; 
        $invoice['date'] = $_POST['date'];
        $invoice['sum_net'] = $_POST['total-net'];
        $invoice['sum_gross'] = $_POST['total-gross'];
        $invoice['city'] = $_POST['city'];
        $invoice['bank'] = $_POST['bank'];
        $invoice['account_no'] = $_POST['account-no'];
        $invoice['payment_term'] = $_POST['term'];
        $invoice['to_pay'] = $_POST['to-pay-numeric'];
        $invoice['to_pay_in_words'] = $_POST['to-pay-verbal'];
        $invoice['additional_notes'] = $_POST['comment'];
        $invoice['customer_name'] = $_POST['customer-name'];
        $invoice['customer_address1'] = $_POST['customer-address1'];
        $invoice['customer_address2'] = $_POST['customer-address1'];
        $invoice['customer_company_no'] = $_POST['customer-company-no'];
        $invoice['seller_name'] = $_POST['seller-name'];
        $invoice['seller_address1'] = $_POST['seller-address1'];
        $invoice['seller_address2'] = $_POST['seller-address1'];
        $invoice['seller_company_no'] = $_POST['seller-company-no'];

        // If $_POST['position'] exists in the $_POST array, it means that the user has assigned services to the invoice
        if (isset($_POST['position'])) {  
                // Reset services      
                $invoice['services'] = [];

                // Covert data from $_POST to variables
                $positions = array_values($_POST['position']);
                $service_names = array_values($_POST['service_name']);
                $service_codes = array_values($_POST['service_code']);
                $quantities = array_values($_POST['quantity']);
                $item_net_prices = array_values($_POST['item_net_price']);
                $service_taxes = array_values($_POST['service_tax']);
                $service_total_nets = array_values($_POST['service_total_net']);
                $service_total_grosses = array_values($_POST['service_total_gross']);

                // Reassign all information to each service
                for ($i=0; $i < count($positions); $i++ ) {
                        $service = []; 
                        $service['position'] = floatval($positions[$i]);
                        $service['service_name'] = $service_names[$i];
                        $service['service_code'] = $service_codes[$i];
                        $service['quantity'] = floatval($quantities[$i]);
                        $service['item_net_price'] = prepare_string_to_save_as_number($item_net_prices[$i]);
                        $service['service_tax'] = $service_taxes[$i];
                        $service['service_total_net'] = prepare_string_to_save_as_number($service_total_nets[$i]);
                        $service['service_total_gross'] = prepare_string_to_save_as_number($service_total_grosses[$i]);

                        $invoice['services'][$i] = $service;
                }
        }

        // Execute different actions depending on whether the user, wants to add, or edit an invoice
        if (isset($_POST['user-wants-edit']) && $_POST['user-wants-edit'] === 'on')
        {
                $invoice_obj->update_invoice($invoice);
                $_SESSION['comment_after_edit'] = "Invoice No. <span>".$invoice['no']."</span> has been successfully amended ";
        }
        else
        {
                $invoice_obj->add_invoice($invoice);
                $_SESSION['comment_after_edit'] = "Invoice No. <span>".$invoice['no']."</span> has been successfully added";
        }
        
        // Assign a variable to be displayed in preview.php
        $_SESSION['invoice_no_to_display'] = $invoice['no'];
}

header('Location: ../preview.php');
?>