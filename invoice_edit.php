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
                                        <input type="text" name="invoice-no" value="<?php 
                                                if (isset($_SESSION['suggestion_invoice_no'])) echo $_SESSION['suggestion_invoice_no'];
                                        ?>">
                                        <p class="error"><?php 
                                                if (isset($_SESSION['e_invoice_no_syntax'])) echo $_SESSION['e_invoice_no_syntax']
                                        ?></p>
                                        <label for="date-edit">Invoice date: </label>
                                        <input class="test" type="date" name="date"value="<?php echo date('Y-m-d') ?>">
                                        <label for="city-edit">City: </label>
                                        <input type="text" name="city" value="<?php 
                                                if (isset($_SESSION['default_invoice_city'])) echo $_SESSION['default_invoice_city'];
                                        ?>">
                                        <label for="bank-edit">Bank: </label>
                                        <input type="text" name="bank" value="<?php 
                                                if (isset($_SESSION['default_invoice_bank_name'])) echo $_SESSION['default_invoice_bank_name'];
                                        ?>">
                                        <label for="account-no-edit">Account no.: </label>
                                        <input type="text" name="account-no" id="account-no-edit" value="<?php 
                                                if (isset($_SESSION['default_invoice_bank_account_no'])) echo $_SESSION['default_invoice_bank_account_no'];
                                        ?>">
                                        <label for="term-edit">Payment term: </label>
                                        <select name="term">
                                                <option value="7 days">7 days</option>
                                                <option value="14 days" selected>14 days</option>
                                        </select>
                                </div>
                                <div class="invoice-edit__form-box invoice-edit__form-box-seller">
                                        <h2>Your data</h2>
                                        <label for="seller-name-edit">Name: </label>
                                        <input type="text" name="seller-name" value="<?php 
                                                if (isset($_SESSION['company_name'])) echo $_SESSION['company_name'];
                                        ?>">
                                        <label for="seller-address1-edit">Address: </label>
                                        <input type="text" name="seller-address1" value="<?php 
                                                if (isset($_SESSION['address1'])) echo $_SESSION['address1'];
                                        ?>">
                                        <label for="seller-address2-edit">Address 2: </label>
                                        <input type="text" name="seller-address2" value="<?php 
                                                 if (isset($_SESSION['address2'])) echo $_SESSION['address2'];
                                        ?>">
                                        <label for="seller-company-no-edit">Company no.: </label>
                                        <input type="text" name="seller-company-no" placeholder="if none enter '---'" value="<?php 
                                                if (isset($_SESSION['company_number'])) echo $_SESSION['company_number'];
                                        ?>">
                                </div>
                                <div class="invoice-edit__form-box invoice-edit__form-box-customer">
                                        <h2>Billed to</h2>
                                        <label for="customer-name-edit">Name: </label>
                                        <input type="text" name="customer-name" value="">
                                        <label for="customer-address1-edit">Address: </label>
                                        <input type="text" name="customer-address1" value="">
                                        <label for="customer-address2-edit">Address 2: </label>
                                        <input type="text" name="customer-address2" value="">
                                        <label for="customer-company-no-edit">Company no.: </label>
                                        <input type="text" name="customer-company-no" value=""
                                                placeholder="if none enter '---'">
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
                                                rows="10"></textarea>
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