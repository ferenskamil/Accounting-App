<?php 
session_start();

require_once './php_scripts/redirect_if_user_not_logged_in.php';
redirect_if_user_not_logged_in('index.php');

$invoice_no_to_display = '';
if (isset($_POST['invoice-no'])) {
        $invoice_no_to_display = $_POST['invoice-no'];
} elseif (isset($_SESSION['invoice_no_to_display'])) {
        $invoice_no_to_display = $_SESSION['invoice_no_to_display'];
        unset($_SESSION['invoice_no_to_display']);
}

if ($invoice_no_to_display !== '') {
        require_once './php_scripts/db_database.php';
        
        $db_query = $db->prepare("SELECT * FROM invoices WHERE user_id = :user_id AND no = :invoice_no");
        $db_query->bindvalue(':user_id', $_SESSION['id'], PDO::PARAM_STR);
        $db_query->bindvalue(':invoice_no', $invoice_no_to_display, PDO::PARAM_STR);
        $db_query->execute();
        $invoice = $db_query->fetch(PDO::FETCH_ASSOC);
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
        <title>Invoice preview</title>
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
        <main class="main invoice">
                <div class="invoice__settings">
                        <button><i class="fa-solid fa-paper-plane"></i>Send</button>
                        <form action="./invoice_edit.php" method="post">
                                <input hidden type="text" value="<?php echo $invoice['no'] ?>" name="invoice_no_to_edit">
                                <button type="submit" class="invoice__settings-edit"><i class="fa-solid fa-pen-to-square"></i>Edit</button>
                        </form>
                        <button><i class="fa-solid fa-trash"></i>Delete</button>
                        <button><i class="fa-solid fa-download"></i>Download</button>
                </div>
                <div class="invoice__container">
                        <div class="invoice__paper">
                                <img class="invoice__paper-logo" src="./dist/img/logos/<?php echo $_SESSION['logo_img'] ?>"
                                        alt="logo firmy wystawiającej fakturę">
                                <h2 class="invoice__paper-title">Invoice no. <span>
                                        <?php echo $invoice['no'] ?>
                                </span></h2>
                                <div class="invoice__paper-content invoice-info">
                                        <p><Strong>Invoice date: </Strong><span>
                                                <?php echo $invoice['date'] ?>
                                        </span></p>
                                        <p><Strong>City: </Strong><span>
                                                <?php echo $invoice['city'] ?>
                                        </span></p>
                                        <p><Strong>Bank: </Strong><span>
                                                <?php echo $invoice['bank'] ?>
                                        </span></p>
                                        <p><Strong>Account no.: </Strong><span>
                                                <?php echo $invoice['account_no'] ?>
                                        </span></p>
                                        <p><Strong>Payment term: </Strong><span>
                                                <?php echo $invoice['payment_term'] ?>
                                        </span></p>
                                </div>
                                <div class="invoice__paper-content invoice-seller">
                                        <h3>Seller:</h3>
                                        <p><span>
                                                <?php echo $invoice['seller_name'] ?>
                                        </span></p>
                                        <p><span>
                                                <?php echo $invoice['seller_address1'] ?>
                                        </span></p>
                                        <p><span>
                                                <?php echo $invoice['seller_address2'] ?>
                                        </span></p>
                                        <p><span>
                                                <?php echo "NIP: ".$invoice['seller_company_no'] ?>
                                        </span></p>
                                </div>
                                <div class="invoice__paper-content invoice-customer">
                                        <h3>Bill to:</h3>
                                        <p><span>
                                                <?php echo $invoice['customer_name'] ?>
                                        </span></p>
                                        <p><span>
                                                <?php echo $invoice['customer_address1'] ?>
                                        </span></p>
                                        <p><span>
                                                <?php echo $invoice['customer_address2'] ?>
                                        </span></p>
                                        <p><span>
                                                <?php echo "NIP: ".$invoice['customer_company_no'] ?>
                                        </span></p>
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
                                                                <td>
                                                                        <?php echo $invoice['sum_net']." PLN" ?>
                                                                </td>
                                                                <td>
                                                                        <?php echo $invoice['sum_gross']." PLN" ?>
                                                                </td>
                                                        </tr>
                                                </tfoot>
                                        </table>
                                </div>
                                <div class="invoice__paper-content invoice-sum">
                                        <p><Strong>To pay: </Strong><span>
                                                <?php echo $invoice['to_pay'] ?>
                                        </span></p>
                                        <p><Strong>In words: </Strong><span>
                                                <?php echo $invoice['to_pay_in_words'] ?>
                                        </span></p>
                                </div>
                                <div class="invoice__paper-content invoice-comments">
                                        <h3>Additional notes</h3>
                                        <p class="comment"><span>
                                                <?php echo $invoice['additional_notes'] ?>
                                        </span></p>
                                        <p class="footnote">*Fill in if the following applies to the good (service). For example, subject exemptions from tax.</p>
                                </div>
                                <div class="invoice__paper-content invoice-sign">
                                        <div class="line"></div>
                                        <p>Signature of authorized person</p>
                                </div>
                        </div>
                </div>
        </main>
        <script src="./dist/js/index.min.js"></script>
</body>

</html>