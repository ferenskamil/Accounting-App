<?php 
session_start();

require_once './php_scripts/redirect_if_user_not_logged_in.php';
redirect_if_user_not_logged_in('index.php');

require_once './php_scripts/suggest_invoice_no.php';

if (isset($_POST['invoice_no_to_edit'])) {
        $_SESSION['invoice_no_to_edit'] = $_POST['invoice_no_to_edit'];
        $_SESSION['is_user_wants_edit'] = true;

        require_once './php_scripts/db_database.php';
        $db_invoice_query = $db->prepare("SELECT * FROM invoices WHERE user_id = :id AND no = :invoice_no");
        $db_invoice_query->bindvalue(':id', $_SESSION['id'], PDO::PARAM_STR);
        $db_invoice_query->bindvalue(':invoice_no', $_POST['invoice_no_to_edit'], PDO::PARAM_STR);
        $db_invoice_query->execute();
        $db_invoice_to_edit = $db_invoice_query->fetch(PDO::FETCH_ASSOC);

        // Download services from database to array
        $db_services_query = $db->prepare("SELECT * FROM services WHERE user_id = :user_id AND invoice_id = :invoice_id");
        $db_services_query->bindvalue(':user_id', $_SESSION['id'], PDO::PARAM_STR);
        $db_services_query->bindvalue(':invoice_id', $db_invoice_to_edit['id'], PDO::PARAM_STR);
        $db_services_query->execute();
        $services_arr = $db_services_query->fetchAll(PDO::FETCH_ASSOC);

        // print_r($services_arr);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./dist/css/main.min.css">

        <!-- FontAwesome Kit -->
<script src="https://kit.fontawesome.com/63681c7143.js" crossorigin="anonymous"></script>

<!-- Poppins - GoogleFonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <title>Invoice edit form</title>
</head>

<body>
        <?php
        if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
        }
?>
<div class="nav">
        <ul class="nav__list">
                <li>
                        <a href="./index.php" class="nav__item">
                                <div class="nav__item-icon"><i class="fa-brands fa-apple"></i></div>
                                <div class="nav__item-title">
                                        <h2>AccountingApp</h2>
                                </div>
                        </a>
                </li>
                <li>
                        <a href="./dashboard.php" class="nav__item">
                                <span class="nav__item-icon"><i class="fa-sharp fa-solid fa-house"></i></span>
                                <span class="nav__item-title">Dashboard</span>
                        </a>
                </li>
                <li>
                        <a href="./invoice_list.php" class="nav__item">
                                <span class="nav__item-icon"><i class="fa-solid fa-users"></i></span>
                                <span class="nav__item-title">Invoice list</span>
                        </a>
                </li>
                <li>
                        <a href="./settings.php" class=" nav__item">
                                <span class="nav__item-icon"><i class="fa-sharp fa-solid fa-gear"></i></span>
                                <span class="nav__item-title">Settings</span>
                        </a>
                </li>
                <li>
                        <a href="./php_scripts/logout.php" class="nav__item">
                                <span class="nav__item-icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                                <span class="nav__item-title">Logout</span>
                        </a>
                </li>
        </ul>
</div>
<div class="topbar">
        <div class="burger-btn-container">
                <button class="burger-btn"><i class="fa-sharp fa-solid fa-bars"></i></button>
        </div>
        <div class="topbar__search">
                <input class="topbar__search-input" type="text" placeholder="Search here">
                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
        </div>
        <div class="topbar__avatar">
                <img src="./dist/img/avatars/<?php echo $_SESSION['avatar_img'] ?>" alt="user photo">
        </div>
        <div class="shadow"></div>
</div>
        <main class="main">
                <div class="invoice-edit">
                        <a href="./invoice_preview.php"><button class="invoice-edit__back"><i class="fa-sharp fa-solid fa-arrow-rotate-left"></i>Return</button></a>
                        <form action="./php_scripts/update_invoice_in_db.php" method="post" class="invoice-edit__form">
                                <div class="invoice-edit__form-box invoice-edit__form-box-details ">
                                        <h2>Details</h2>
                                        <label for="invoice-no-edit">Invoice no.</label>
                                        <?php
                                                if (isset($_POST['invoice_no_to_edit'])) {
                                                        echo '<input readonly type="text" name="invoice-no" value='.$_POST['invoice_no_to_edit'].'>';
                                                        
                                                } else if (isset($_SESSION['suggestion_invoice_no'])) {
                                                        echo '<input type="text" name="invoice-no" value='.$_SESSION['suggestion_invoice_no'].'>';
                                                }
                                        ?>
                                        <p class="error"><?php 
                                                if (isset($_SESSION['e_invoice_no_syntax'])) echo $_SESSION['e_invoice_no_syntax']
                                        ?></p>
                                        <label for="date-edit">Invoice date: </label>
                                        <input class="test" type="date" name="date" value="<?php 
                                                if (isset($_POST['invoice_no_to_edit'])) {
                                                        echo $db_invoice_to_edit['date'];
                                                } else {
                                                        echo date('Y-m-d');
                                                }
                                                
                                        ?>">
                                        <label for="city-edit">City: </label>
                                        <input type="text" name="city" value="<?php 
                                                if (isset($_POST['invoice_no_to_edit'])){
                                                        echo $db_invoice_to_edit['city'];
                                                } 
                                                elseif(isset($_SESSION['default_invoice_city'])) {
                                                        echo $_SESSION['default_invoice_city'];
                                                }
                                        ?>">
                                        <label for="bank-edit">Bank: </label>
                                        <input type="text" name="bank" value="<?php 
                                                if (isset($_POST['invoice_no_to_edit'])){
                                                        echo $db_invoice_to_edit['bank'];
                                                } 
                                                elseif(isset($_SESSION['default_invoice_bank_name'])) {
                                                        echo $_SESSION['default_invoice_bank_name'];
                                                }
                                        ?>">
                                        <label for="account-no-edit">Account no.: </label>
                                        <input type="text" name="account-no" id="account-no-edit" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])){
                                                        echo $db_invoice_to_edit['account_no'];
                                                } 
                                                elseif(isset($_SESSION['default_invoice_bank_account_no'])) {
                                                        echo $_SESSION['default_invoice_bank_account_no'];
                                                }                                        
                                        ?>">
                                        <label for="term-edit">Payment term: </label>
                                        <select name="term">
                                                <option value="7 days" <?php 
                                                        if (isset($_POST['invoice_no_to_edit']) && $db_invoice_to_edit === '7 days') {
                                                                echo 'selected';
                                                        }
                                                ?>>7 days</option>
                                                <option value="14 days" <?php 
                                                        if (isset($_POST['invoice_no_to_edit']) && $db_invoice_to_edit === '14 days') {
                                                                echo 'selected';
                                                        } elseif (!isset($_POST['invoice_no_to_edit'])) {
                                                                echo 'selected';
                                                        }
                                                ?>>14 days</option>
                                        </select>
                                </div>
                                <div class="invoice-edit__form-box invoice-edit__form-box-seller">
                                        <h2>Your data</h2>
                                        <label for="seller-name-edit">Name: </label>
                                        <input type="text" name="seller-name" value="<?php 
                                                if (isset($_POST['invoice_no_to_edit'])){
                                                        echo $db_invoice_to_edit['seller_name'];
                                                } 
                                                elseif(isset($_SESSION['company_name'])) {
                                                        echo $_SESSION['company_name'];
                                                }
                                        ?>">
                                        <label for="seller-address1-edit">Address: </label>
                                        <input type="text" name="seller-address1" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])){
                                                        echo $db_invoice_to_edit['seller_address1'];
                                                } 
                                                elseif(isset($_SESSION['address1'])) {
                                                        echo $_SESSION['address1'];
                                                }
                                        ?>">
                                        <label for="seller-address2-edit">Address 2: </label>
                                        <input type="text" name="seller-address2" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])){
                                                        echo $db_invoice_to_edit['seller_address2'];
                                                } 
                                                elseif(isset($_SESSION['address2'])) {
                                                        echo $_SESSION['address2'];
                                                }
                                        ?>">
                                        <label for="seller-company-no-edit">Company no.: </label>
                                        <input type="text" name="seller-company-no" placeholder="if none enter '---'" value="<?php
                                                if (isset($_POST['invoice_no_to_edit'])){
                                                        echo $db_invoice_to_edit['seller_company_no'];
                                                } 
                                                elseif(isset($_SESSION['company_number'])) {
                                                        echo $_SESSION['company_number'];
                                                }
                                        ?>">
                                </div>
                                <div class="invoice-edit__form-box invoice-edit__form-box-customer">
                                        <h2>Billed to</h2>
                                        <label for="customer-name-edit">Name: </label>
                                        <input type="text" name="customer-name" value="<?php 
                                                if (isset($_POST['invoice_no_to_edit'])) {
                                                        echo $db_invoice_to_edit['customer_name'] ;
                                                }
                                        ?>">
                                        <label for="customer-address1-edit">Address: </label>
                                        <input type="text" name="customer-address1" value="<?php 
                                                if (isset($_POST['invoice_no_to_edit'])) {
                                                        echo $db_invoice_to_edit['customer_address1'] ;
                                                }
                                        ?>">
                                        <label for="customer-address2-edit">Address 2: </label>
                                        <input type="text" name="customer-address2" value="<?php 
                                                if (isset($_POST['invoice_no_to_edit'])) {
                                                        echo $db_invoice_to_edit['customer_address2'] ;
                                                }
                                        ?>">
                                        <label for="customer-company-no-edit">Company no.: </label>
                                        <input type="text" name="customer-company-no" value="<?php 
                                                if (isset($_POST['invoice_no_to_edit'])) {
                                                        echo $db_invoice_to_edit['customer_company_no'] ;
                                                }
                                        ?>" placeholder="if none enter '---'">
                                </div>
                                <div class="invoice-edit__form-box invoice-edit__form-box-services">
                                        <h2>Services</h2>
                                        <table class="invoice-edit__form-box-services-table">
                                                <thead>
                                                        <tr>
                                                                <th class="service-thead--mobile">Services
                                                                        list</th>
                                                                <th class="service-thead--large">No.</th>
                                                                <th class="service-thead--large">Item / service</th>
                                                                <th class="service-thead--large">Service code</th>
                                                                <th class="service-thead--large">Quantity</th>
                                                                <th class="service-thead--large">Net price (PLN)</th>
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
                                                        if (isset($_SESSION['is_user_wants_edit'])){
                                                                for ($i=0; $i < count($services_arr) ; $i++) { 
                                                                        $service = $services_arr[$i];

                                                                        if ($service['service_tax'] === '0.08') {
                                                                                $tax_options = '
                                                                                <option value="0">tax-free</option>
                                                                                <option value="0.08" checked>8%</option>
                                                                                <option value="0.23">23%</option>';
                                                                        } elseif ($service['service_tax'] === '0.23') {
                                                                                $tax_options = '
                                                                                <option value="0">tax-free</option>
                                                                                <option value="0.08">8%</option>
                                                                                <option value="0.23" checked>23%</option>';
                                                                        } else {
                                                                                $tax_options = '
                                                                                <option value="0" checked>tax-free</option>
                                                                                <option value="0.08">8%</option>
                                                                                <option value="0.23">23%</option>';        
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
                                                                                <span class="service-title--mobile">Net price (PLN): </span>
                                                                                <input type="number" min="0" value="'.$service['item_net_price'].'" class="service-item-net-value" name="item_net_price['.$i.']">
                                                                        </td>
                                                                        <td>
                                                                                <span class="service-title--mobile">Tax: </span>
                                                                                <select class="service-item-tax" name="service_tax['.$i.']">
                                                                                        <option value="0">tax-free</option>
                                                                                        <option value="0.08">8%</option>
                                                                                        <option value="0.23">23%</option>
                                                                                </select>
                                                                        </td>
                                                                        <td>
                                                                                <span class="service-title--mobile">Net sum (PLN): </span>
                                                                                <input type="text" value="'.$service['service_total_net'].' PLN" class="service-item-net-sum" name="service_total_net['.$i.']" readonly>
                                                                        </td>
                                                                        <td>
                                                                                <span class="service-title--mobile">Gross sum (PLN): </span>
                                                                                <input type="text" value="'.$service['service_total_gross'].' PLN" class="service-item-gross-sum" name="service_total_gross['.$i.']" readonly>
                                                                        </td>
                                                                        <td>
                                                                                <button class="delete-btn"><i class="fa-solid fa-trash"></i>Delete</button>
                                                                        </td>
                                                                </tr>'); 
                                                                }
                                                        };
                                                        }
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
                                                                        <span class="invoice-total-net">0.00 PLN</span>
                                                                        <input type="text" hidden name="total-net" id="total-net" value="0.00">
                                                                </td>
                                                                <td><span class="service-title--mobile">
                                                                        <strong>Gross:</strong></span>
                                                                        <span class="invoice-total-gross">0.00 PLN</span>
                                                                        <input type="text" hidden name="total-gross" id="total-gross" value="0.00">
                                                                </td>
                                                        </tr>
                                                </tfoot>
                                        </table>
                                        <input type="text" hidden name="to-pay-numeric" id="to-pay-numeric" value="0.00">
                                        <input type="text" hidden name="to-pay-verbal" id="to-pay-verbal" value="zero PLN 00/100">
                                </div>
                                <div class="invoice-edit__form-box invoice-edit__form-box-comments">
                                        <h2>Additional notes</h2>
                                        <p>*Fill in if the following applies to the good (service). For example, subject exemptions from tax.</p>
                                        <textarea name="comment" id="comment-edit" cols="30"
                                                rows="10"><?php 
                                                        if (isset($_POST['invoice_no_to_edit'])){
                                                                echo $db_invoice_to_edit['additional_notes'];
                                                        } 
                                                        elseif(isset($_SESSION['default_invoice_city'])) {
                                                                echo $_SESSION['default_invoice_additional_info'];
                                                        }
                                        ?></textarea>
                                </div>
                                <div class="invoice-edit__form-box-submit-btn">
                                        <button type="submit"><i class="fa-solid fa-floppy-disk "></i>Save</button>
                                </div>
                        </form>
                </div>
        </main>
        <script src="./dist/js/index.min.js"></script>
        <script src="./dist/js/invoice/num_to_word.min.js"></script>
        <script src="./dist/js/invoice/edit_form_services.min.js"></script>
        <script src="./dist/js/invoice/edit_form_validation.min.js"></script>
</body>

</html>