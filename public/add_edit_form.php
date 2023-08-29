<?php
session_start();

require_once './scripts/redirect_if_user_not_logged_in.php';
redirect_if_user_not_logged_in('index.php');

// Before starting the script, remove the flag that may not have been removed
unset($_SESSION['edited_invoice_no']);

// Get user data to $user assoc array
if (isset($_SESSION['user'])) $user = $_SESSION['user'];

// Check if the user tried to edit the invoice. The data should be passed from the 'previw.php' page using the 'POST' method.
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
if (strpos($referer, 'public/preview.php') !== false  &&
        $_SERVER["REQUEST_METHOD"] === "POST" &&
        isset($_POST['invoice_no_to_edit']))
{
        // Set a flag, indicating that the user wants to edit (will be removed in the script "update_invoice_in_db.php")
        $_SESSION['edited_invoice_no'] = $_POST['invoice_no_to_edit'];


        // Create an instance of the Invoice class.
        require_once '../class/invoice.class.php';
        $invoice_obj = new Invoice($_POST['invoice_no_to_edit'] , $user['id']);

        // Assign associative array with invoice information to $invoice variable
        $invoice = $invoice_obj->get_invoice();

        // Assign services to $services variable
        $services = $invoice['services'];

        // Set $_SESSION['invoice_no_to_display'], if the user would like to return to preview
        $_SESSION['invoice_no_to_display'] = $invoice['no'];
}
// If the user is not trying to edit then they probably want to create a new invoice
else
{
        // Suggest No. for new invoice
        require_once './scripts/suggest_invoice_no.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once '../templates/head_links.php'; ?>
        <title>Invoice edit form</title>
</head>

<body>
        <?php require_once '../templates/nav_topbar.php'; ?>
        <main class="main">
                <div class="invoice-edit">
                        <a href="<?php
                                if (isset($_POST['invoice_no_to_edit'])) {
                                        echo "./preview.php";
                                } else {
                                        echo "./list.php";
                                }
                        ?>">
                                <button class="invoice-edit__back">
                                        <i class="fa-sharp fa-solid fa-arrow-rotate-left"></i>Return
                                </button>
                        </a>
                        <form action="./scripts/update_invoice_in_db.php" method="post" class="invoice-edit__form">
                                <div class="invoice-edit__form-box invoice-edit__form-box-details ">
                                        <h2>Details</h2>
                                        <label for="invoice-no">Invoice no.</label>
                                        <?php
                                                if (isset($_POST['invoice_no_to_edit'])) {
                                                        echo '<input readonly type="text" name="invoice-no" id="invoice-no"
                                                        value='.$_POST['invoice_no_to_edit'].'>';
                                                        echo '<input hidden checked type="checkbox" name="user-wants-edit" >';
                                                } else if (isset($_SESSION['suggestion_invoice_no'])) {
                                                        echo '<input type="text" name="invoice-no" id="invoice-no"
                                                        value='.$_SESSION['suggestion_invoice_no'].'>';
                                                }
                                        ?>
                                        <p class="error"><?php
                                                if (isset($_SESSION['e_invoice_no_syntax'])) echo $_SESSION['e_invoice_no_syntax']
                                        ?></p>
                                        <label for="date">Invoice date: </label>
                                        <input class="test" type="date" name="date" id="date" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])) {
                                                        echo $invoice['date'];
                                                } else {
                                                        echo date('Y-m-d');
                                                }

                                        ?>">
                                        <label for="city">City: </label>
                                        <input type="text" name="city" id="city" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])){
                                                        echo $invoice['city'];
                                                }
                                                elseif(isset($user['city'])) {
                                                        echo $user['city'];
                                                }
                                        ?>">
                                        <label for="bank">Bank: </label>
                                        <input type="text" name="bank" id="bank" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])){
                                                        echo $invoice['bank'];
                                                }
                                                elseif(isset($user['bank'])) {
                                                        echo $user['bank'];
                                                }
                                        ?>">
                                        <label for="account-no">Account no.: </label>
                                        <input type="text" name="account-no" id="account-no" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])){
                                                        echo $invoice['account_no'];
                                                }
                                                elseif(isset($user['account_no'])) {
                                                        echo $user['account_no'];
                                                }
                                        ?>">
                                        <label for="term">Payment term: </label>
                                        <select name="term" id="term">
                                                <option value="7 days" <?php
                                                        if (isset($_POST['invoice_no_to_edit']) && $invoice === '7 days') {
                                                                echo 'selected';
                                                        }
                                                ?>>7 days</option>
                                                <option value="14 days" <?php
                                                        if (isset($_POST['invoice_no_to_edit']) && $invoice === '14 days') {
                                                                echo 'selected';
                                                        } elseif (!isset($_POST['invoice_no_to_edit'])) {
                                                                echo 'selected';
                                                        }
                                                ?>>14 days</option>
                                        </select>
                                </div>
                                <div class="invoice-edit__form-box invoice-edit__form-box-seller">
                                        <h2>Your data</h2>
                                        <label for="seller-name">Name: </label>
                                        <input type="text" name="seller-name" id="seller-name" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])){
                                                        echo $invoice['seller_name'];
                                                }
                                                elseif(isset($user['company'])) {
                                                        echo $user['company'];
                                                }
                                        ?>">
                                        <label for="seller-address1">Address: </label>
                                        <input type="text" name="seller-address1" id="seller-address1" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])){
                                                        echo $invoice['seller_address1'];
                                                }
                                                elseif(isset($user['address1'])) {
                                                        echo $user['address1'];
                                                }
                                        ?>">
                                        <label for="seller-address2">Address 2: </label>
                                        <input type="text" name="seller-address2" id="seller-address2" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])){
                                                        echo $invoice['seller_address2'];
                                                }
                                                elseif(isset($user['address2'])) {
                                                        echo $user['address2'];
                                                }
                                        ?>">
                                        <label for="seller-company-no">Company no.: </label>
                                        <input type="text" name="seller-company-no" id="seller-company-no" placeholder="if none enter '---'" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])){
                                                        echo $invoice['seller_company_no'];
                                                }
                                                elseif(isset($user['company_code'])) {
                                                        echo $user['company_code'];
                                                }
                                        ?>">
                                </div>
                                <div class="invoice-edit__form-box invoice-edit__form-box-customer">
                                        <h2>Billed to</h2>
                                        <label for="customer-name">Name: </label>
                                        <input type="text" name="customer-name" id="customer-name" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])) {
                                                        echo $invoice['customer_name'] ;
                                                }
                                        ?>">
                                        <label for="customer-address1">Address: </label>
                                        <input type="text" name="customer-address1" id="customer-address1" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])) {
                                                        echo $invoice['customer_address1'] ;
                                                }
                                        ?>">
                                        <label for="customer-address2">Address 2: </label>
                                        <input type="text" name="customer-address2" id="customer-address2" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])) {
                                                        echo $invoice['customer_address2'] ;
                                                }
                                        ?>">
                                        <label for="customer-company-no">Company no.: </label>
                                        <input type="text" name="customer-company-no" id="customer-company-no" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])) {
                                                        echo $invoice['customer_company_no'] ;
                                                }
                                        ?>" placeholder="if none enter '---'">
                                </div>
                                <div class="invoice-edit__form-box invoice-edit__form-box-services">
                                        <h2>Services</h2>
                                        <table class="invoice-edit__form-box-services-table" id="services-table">
                                                <thead>
                                                        <tr>
                                                                <th class="service-thead--mobile">Services
                                                                        list</th>
                                                                <th class="service-thead--large">No.</th>
                                                                <th class="service-thead--large">Item / service</th>
                                                                <th class="service-thead--large">Service code</th>
                                                                <th class="service-thead--large">Quantity</th>
                                                                <th class="service-thead--large">Net price ($)</th>
                                                                <th class="service-thead--large">Tax</th>
                                                                <th class="service-thead--large">Net sum</th>
                                                                <th class="service-thead--large">Gross sum</th>
                                                                <th class="service-thead--large"></th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <tr class="empty-info">
                                                                <td>No items to display</td>
                                                        </tr>
                                                        <?php
                                                        if (isset($services)){
                                                                for ($i=0; $i < count($services) ; $i++) {
                                                                        $service = $services[$i];

                                                                        if ($service['service_tax'] === '0.08') {
                                                                                $tax_options = '
                                                                                <option value="0">tax-free</option>
                                                                                <option value="0.08" selected>8%</option>
                                                                                <option value="0.23">23%</option>';
                                                                        } elseif ($service['service_tax'] === '0.23') {
                                                                                $tax_options = '
                                                                                <option value="0">tax-free</option>
                                                                                <option value="0.08">8%</option>
                                                                                <option value="0.23" selected>23%</option>';
                                                                        } else {
                                                                                $tax_options = '
                                                                                <option value="0" selected>tax-free</option>
                                                                                <option value="0.08">8%</option>
                                                                                <option value="0.23">23%</option>';
                                                                        };
                                                                echo('
                                                                <tr>
                                                                        <td>
                                                                                <span class="service-title--mobile">No.: </span>
                                                                                <span class="service-item-number">'.$service['position'].'</span>
                                                                                <input hidden="" class="position-hidden-input" type="text" name="position['.$i.']">
                                                                        </td>
                                                                        <td>
                                                                                <span class="service-title--mobile">Item / service: </span>
                                                                                <input class="service-item-name" type="text" name="service_name['.$i.']" value="'.$service['service_name'].'">
                                                                        </td>
                                                                        <td>
                                                                                <span class="service-title--mobile">Service code: </span>
                                                                                <input class="service-item-code" type="text" name="service_code['.$i.']" value="'.$service['service_code'].'">
                                                                        </td>
                                                                        <td>
                                                                                <span class="service-title--mobile">Quantity: </span>
                                                                                <input type="number" value="'.$service['quantity'].'" min="0" class="service-item-amount" name="quantity['.$i.']">
                                                                        </td>
                                                                        <td>
                                                                                <span class="service-title--mobile">Net price ($): </span>
                                                                                <input type="number" min="0" value="'.$service['item_net_price'].'" class="service-item-net-value" name="item_net_price['.$i.']" step=".01">
                                                                        </td>
                                                                        <td>
                                                                                <span class="service-title--mobile">Tax: </span>
                                                                                <select class="service-item-tax" name="service_tax['.$i.']">
                                                                                        '.$tax_options.'
                                                                                </select>
                                                                        </td>
                                                                        <td>
                                                                                <span class="service-title--mobile">Net sum ($): </span>
                                                                                <input type="text" value="'.number_format($service['service_total_net'],2,',',' ').' $" class="service-item-net-sum" name="service_total_net['.$i.']" readonly>
                                                                        </td>
                                                                        <td>
                                                                                <span class="service-title--mobile">Gross sum ($): </span>
                                                                                <input type="text" value="'.number_format($service['service_total_gross'],2,',',' ').' $" class="service-item-gross-sum" name="service_total_gross['.$i.']" readonly>
                                                                        </td>
                                                                        <td>
                                                                                <button class="delete-btn"><i class="fa-solid fa-trash"></i>Delete</button>
                                                                        </td>
                                                                </tr>');
                                                                };
                                                        };
                                                        ?>
                                                </tbody>
                                                <tfoot>
                                                        <tr>
                                                                <td><button class="new-service-btn"><i
                                                                                        class="fa-sharp fa-solid fa-plus"></i>
                                                                                Add new</button></td>
                                                                <td><strong>TOTAL:</strong></td>
                                                                <td><span class="service-title--mobile">
                                                                        <strong>Net:</strong></span>
                                                                        <span class="invoice-total-net">0,00 $</span>
                                                                        <input type="text" hidden name="total-net" id="total-net" value="0.00">
                                                                </td>
                                                                <td><span class="service-title--mobile">
                                                                        <strong>Gross:</strong></span>
                                                                        <span class="invoice-total-gross">0.00 $</span>
                                                                        <input type="text" hidden name="total-gross" id="total-gross" value="0.00">
                                                                </td>
                                                        </tr>
                                                </tfoot>
                                        </table>
                                        <input type="text" hidden name="to-pay-numeric" id="to-pay-numeric" value="0.00">
                                        <input type="text" hidden name="to-pay-verbal" id="to-pay-verbal" value="zero $ 00/100">
                                </div>
                                <div class="invoice-edit__form-box invoice-edit__form-box-comments">
                                        <label for="comment"><h2>Additional notes</h2></label>
                                        <p>*Fill in if the following applies to the good (service). For example, subject exemptions from tax.</p>
                                        <textarea name="comment" id="comment" cols="30"
                                                rows="10"><?php
                                                        if (isset($_POST['invoice_no_to_edit'])){
                                                                echo $invoice['additional_notes'];
                                                        }
                                                        elseif(isset($user['additional_info'])) {
                                                                echo $user['additional_info'];
                                                        }
                                        ?></textarea>
                                </div>
                                <div class="invoice-edit__form-box-submit-btn">
                                        <button type="submit"><i class="fa-solid fa-floppy-disk "></i>Save</button>
                                </div>
                        </form>
                </div>
        </main>
        <script src="../assets/js/common/nav.min.js"></script>
        <script src="../assets/js/common/verbal_notation.min.js"></script>
        <script src="../assets/js/pages/add_edit_form/edit_form_services.min.js"></script>
        <script src="../assets/js/pages/add_edit_form/edit_form_validation.min.js"></script>
        <script type="module" src="../assets/js/common/sanitize_account_no_input.min.js"></script>
</body>

</html>