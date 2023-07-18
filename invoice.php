<?php 
session_start();

require_once './php_scripts/redirect_if_user_not_logged_in.php';
redirect_if_user_not_logged_in('index.php');

require_once './php_scripts/suggest_invoice_no.php';
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
        <title>Invoice</title>
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
                        <a href="./invoice.php" class="nav__item">
                                <span class="nav__item-icon"><i class="fa-solid fa-message"></i></span>
                                <span class="nav__item-title">Invoice</span>
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
        <main class="main invoice">
                <div class="invoice__settings">
                        <button><i class="fa-solid fa-paper-plane"></i>Send</button>
                        <button class="invoice__settings-edit"><i class="fa-solid fa-pen-to-square"></i>Edit</button>
                        <button><i class="fa-solid fa-trash"></i>Delete</button>
                        <button><i class="fa-solid fa-download"></i>Download</button>
                </div>
                <div class="invoice__container">
                        <div class="invoice__paper">
                                <img class="invoice__paper-logo" src="./dist/img/logos/<?php echo $_SESSION['logo_img'] ?>"
                                        alt="logo firmy wystawiającej fakturę">
                                <h2 class="invoice__paper-title">Invoice no. <span id="invoice-no-view"></span></h2>
                                <div class="invoice__paper-content invoice-info">
                                        <p><Strong>Invoice date: </Strong><span id="date-view"></span></p>
                                        <p><Strong>City: </Strong><span id="city-view"></span></p>
                                        <p><Strong>Bank: </Strong><span id="bank-view"></span></p>
                                        <p><Strong>Account no.: </Strong><span id="account-no-view"></span></p>
                                        <p><Strong>Payment term: </Strong><span id="term-view"></span></p>
                                </div>
                                <div class="invoice__paper-content invoice-seller">
                                        <h3>Seller:</h3>
                                        <p><span id="seller-name-view"></span></p>
                                        <p><span id="seller-address1-view"></span></p>
                                        <p><span id="seller-address2-view"></span></p>
                                        <p><span id="seller-company-no-view"></span></p>
                                </div>
                                <div class="invoice__paper-content invoice-customer">
                                        <h3>Bill to:</h3>
                                        <p><span id="customer-name-view"></span></p>
                                        <p><span id="customer-address1-view"></span></p>
                                        <p><span id="customer-address2-view"></span></p>
                                        <p><span id="customer-company-no-view"></span></p>
                                </div>
                                <div class="invoice__paper-content invoice__paper-services">
                                        <table>
                                                <thead>
                                                        <tr>
                                                                <th>No.</th>
                                                                <th>Item / service</th>
                                                                <th>Service code</th>
                                                                <th>Quantity</th>
                                                                <th>Net price</th>
                                                                <th>Tax</th>
                                                                <th>Net sum</th>
                                                                <th>Gross sum</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                        <tr>
                                                                <td colspan="4"></td>
                                                                <td>TOTAL:</td>
                                                                <td></td>
                                                                <td class="preview-total-net">0 PLN</td>
                                                                <td class="preview-total-gross">0 PLN</td>
                                                        </tr>
                                                </tfoot>
                                        </table>
                                </div>
                                <div class="invoice__paper-content invoice-sum">
                                        <p><Strong>To pay: </Strong><span id="invoice__sum-numeric"></span>
                                                PLN
                                        </p>
                                        <p><Strong>In words: </Strong><span id="invoice__sum-verbal"></span></p>
                                </div>
                                <div class="invoice__paper-content invoice-comments">
                                        <h3>Additional notes</h3>
                                        <p class="comment"><span id="comment-view"></span></p>
                                        <p class="footnote">*Fill in if the following applies to the good (service). For example, subject exemptions from tax.</p>
                                </div>
                                <div class="invoice__paper-content invoice-sign">
                                        <div class="line"></div>
                                        <p>Signature of authorized person</p>
                                </div>
                        </div>
                </div>
                <div class="invoice__edit">
                        <button class="invoice__edit-back"><i
                                        class="fa-sharp fa-solid fa-arrow-rotate-left"></i>Return</button>
                        <form action="./php_scripts/update_invoice_in_db.php" method="post" class="invoice__edit-form">
                                <div class="invoice__edit-form-box invoice__edit-form-box-details ">
                                        <h2>Details</h2>
                                        <label for="invoice-no-edit">Invoice no.</label>
                                        <input type="text" name="invoice-no" id="invoice-no-edit" value="<?php 
                                                if (isset($_SESSION['suggestion_invoice_no'])) echo $_SESSION['suggestion_invoice_no'];
                                        ?>">
                                        <p class="error"><?php 
                                                if (isset($_SESSION['e_invoice_no_syntax'])) echo $_SESSION['e_invoice_no_syntax']
                                        ?></p>
                                        <label for="date-edit">Invoice date: </label>
                                        <input class="test" type="date" name="date" id="date-edit" value="<?php echo date('Y-m-d') ?>">
                                        <label for="city-edit">City: </label>
                                        <input type="text" name="city" id="city-edit" value="<?php 
                                                if (isset($_SESSION['default_invoice_city'])) echo $_SESSION['default_invoice_city'];
                                        ?>">
                                        <label for="bank-edit">Bank: </label>
                                        <input type="text" name="bank" id="bank-edit" value="<?php 
                                                if (isset($_SESSION['default_invoice_bank_name'])) echo $_SESSION['default_invoice_bank_name'];
                                        ?>">
                                        <label for="account-no-edit">Account no.: </label>
                                        <input type="text" name="account-no" id="account-no-edit" value="<?php 
                                                if (isset($_SESSION['default_invoice_bank_account_no'])) echo $_SESSION['default_invoice_bank_account_no'];
                                        ?>">
                                        <label for="term-edit">Payment term: </label>
                                        <select name="term" id="term-edit">
                                                <option value="7 days">7 days</option>
                                                <option value="14 days" selected>14 days</option>
                                        </select>
                                </div>
                                <div class="invoice__edit-form-box invoice__edit-form-box-seller">
                                        <h2>Your data</h2>
                                        <label for="seller-name-edit">Name: </label>
                                        <input type="text" name="seller-name" id="seller-name-edit" value="<?php 
                                                if (isset($_SESSION['company_name'])) echo $_SESSION['company_name'];
                                        ?>">
                                        <label for="seller-address1-edit">Address: </label>
                                        <input type="text" name="seller-address1" id="seller-address1-edit" value="<?php 
                                                if (isset($_SESSION['address1'])) echo $_SESSION['address1'];
                                        ?>">
                                        <label for="seller-address2-edit">Address 2: </label>
                                        <input type="text" name="seller-address2" id="seller-address2-edit" value="<?php 
                                                 if (isset($_SESSION['address2'])) echo $_SESSION['address2'];
                                        ?>">
                                        <label for="seller-company-no-edit">Company no.: </label>
                                        <input type="text" name="seller-company-no" id="seller-company-no-edit" placeholder="if none enter '---'" value="<?php 
                                                if (isset($_SESSION['company_number'])) echo $_SESSION['company_number'];
                                        ?>">
                                </div>
                                <div class="invoice__edit-form-box invoice__edit-form-box-customer">
                                        <h2>Billed to</h2>
                                        <label for="customer-name-edit">Name: </label>
                                        <input type="text" name="customer-name" id="customer-name-edit"
                                                value="">
                                        <label for="customer-address1-edit">Address: </label>
                                        <input type="text" name="customer-address1" id="customer-address1-edit"
                                                value="">
                                        <label for="customer-address2-edit">Address 2: </label>
                                        <input type="text" name="customer-address2" id="customer-address2-edit"
                                                value="">
                                        <label for="customer-company-no-edit">Company no.: </label>
                                        <input type="text" name="customer-company-no" id="customer-company-no-edit" value=""
                                                placeholder="if none enter '---'">
                                </div>
                                <div class="invoice__edit-form-box invoice__edit-form-box-services">
                                        <h2>Services</h2>
                                        <table class="invoice__edit-form-box-services-table">
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
                                <div class="invoice__edit-form-box invoice__edit-form-box-comments">
                                        <h2>Additional notes</h2>
                                        <p>*Fill in if the following applies to the good (service). For example, subject exemptions from tax.</p>
                                        <textarea name="comment" id="comment-edit" cols="30"
                                                rows="10"></textarea>
                                </div>
                                <div class="invoice__edit-form-box-submit-btn">
                                        <button type="submit"><i class="fa-solid fa-floppy-disk "></i>Save</button>
                                </div>
                        </form>
                </div>
        </main>
        <script src="./dist/js/index.min.js"></script>
        <script src="./dist/js/invoice/num_to_word.min.js"></script>
        <script src="./dist/js/invoice/prepare_form.min.js"></script>
        <script src="./dist/js/invoice/open_hide_edit_form.min.js"></script>
        <script src="./dist/js/invoice/edit_form_validation.min.js"></script>
        <script src="./dist/js/invoice/edit_form_services.min.js"></script>
        <script src="./dist/js/invoice/transfer_data_from_edit_to_preview.min.js"></script>
</body>

</html>