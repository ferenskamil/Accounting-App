<?php
session_start();

require_once './php_scripts/redirect_if_user_not_logged_in.php';
redirect_if_user_not_logged_in('index.php');

require_once './php_scripts/db_database.php';
$db_query = $db->prepare("SELECT * FROM invoices WHERE user_id = :id");
$db_query->bindvalue(':id', $_SESSION['id'], PDO::PARAM_STR);
$db_query->execute();
$user_invoices = $db_query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- FontAwesome Kit -->
<script src="https://kit.fontawesome.com/63681c7143.js" crossorigin="anonymous"></script>

<!-- Poppins - GoogleFonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- CSS stylesheet -->
<link rel="stylesheet" href="./dist/css/main.min.css">
        <title>Invoice List</title>
</head>

<body>
        <div class="confirm__shadow">
                <div class="confirm__pop-up">
                        <div class="confirm__pop-up-message">
                                <p>Are you sure you want to delete invoice number 
                                        <span>01/01/2023</span> ?</p>
                        </div>
                        <div class="confirm__pop-up-buttons">
                                <form action="./php_scripts/delete_invoice.php" method="post">
                                        <input hidden type="text" id="pop-up-invoice-no-hidden-input" name="pop-up-invoice-no-hidden-input">
                                        <button type="submit" class="confirm__pop-up-buttons-delete">Delete</button>
                                </form>
                                <button class="confirm__pop-up-buttons-return">Return</button>
                        </div>
                </div>       
        </div>

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
        <main class="main invoice-list">
                <a href="./invoice_edit.php" class="invoice-list__add-new-btn">
                        <button>
                                <i class="fa-solid fa-plus"></i>Add new invoice
                        </button>
                </a>
                <?php
                        if (isset($_SESSION['comment_after_delete'])) {
                                echo('
                                <div class="invoice-list__pop-up pop-up">
                                        <div class="invoice__pop-up-box">
                                                <i class="fa-solid fa-trash-can"></i>
                                                <p class="invoice__pop-up-text">'.$_SESSION['comment_after_delete'].'</p>
                                        </div>
                                        <button class="close-pop-up">
                                                <i class="fa-solid fa-xmark"></i>
                                        </button>
                                </div>');

                                unset($_SESSION['comment_after_delete']);
                        } else if (isset($_SESSION['comment_download_error'])) {
                                echo('
                                <div class="invoice-list__pop-up pop-up">
                                        <div class="invoice__pop-up-box">
                                                <i class="fa-solid fa-trash-can"></i>
                                                <p class="invoice__pop-up-text">'.$_SESSION['comment_download_error'].'</p>
                                        </div>
                                        <button class="close-pop-up">
                                                <i class="fa-solid fa-xmark"></i>
                                        </button>
                                </div>');

                                unset($_SESSION['comment_download_error']);
                        }
                ?>
                <table class="invoice-list__table">
                        <thead class="invoice-list__table-thead">
                                <tr>
                                        <th class="invoice-list__table-thead--mobile">Invoices</th>
                                        <th class="invoice-list__table-thead--tablet">Invoice No</th>
                                        <th class="invoice-list__table-thead--tablet">Contractor</th>
                                        <th class="invoice-list__table-thead--tablet">Contractor No</th>
                                        <th class="invoice-list__table-thead--tablet">Gross</th>
                                        <th class="invoice-list__table-thead--tablet">Net</th>
                                        <th class="invoice-list__table-thead--tablet">Status</th>
                                        <th class="invoice-list__table-thead--PC">Settings</th>
                                </tr>
                        </thead>
                        <tbody class="invoice-list__table-tbody">
                                <tr class="invoice-list__table-tbody-empty_info">
                                        <td>You have not created any invoice yet. <a href="./invoice_edit.php">
                                                Create one now
                                        </a></td>
                                </tr>
                                <?php
                                      foreach ($user_invoices as $invoice) {
                                        $item = '
                                        <tr class="invoice-list__table-tbody-item">
                                                <td><span class="invoice-list__table-tbody-item--mobile-title">Invoice No:
                                                        </span>
                                                        <span>'.$invoice['no'].'</span>
                                                </td>
                                                <td><span class="invoice-list__table-tbody-item--mobile-title">Contractor:
                                                        </span>
                                                        '.$invoice['customer_name'].'
                                                </td>
                                                <td><span class="invoice-list__table-tbody-item--mobile-title">Contractor No:
                                                        </span>
                                                        '.$invoice['customer_company_no'].'
                                                </td>
                                                <td><span class="invoice-list__table-tbody-item--mobile-title">Gross:
                                                        </span>
                                                        '.$invoice['sum_gross'].' $
                                                </td>
                                                <td><span class="invoice-list__table-tbody-item--mobile-title">Net:
                                                        </span>
                                                        '.$invoice['sum_net'].' $
                                                </td>
                                                <td><span class="invoice-list__table-tbody-item--mobile-title">Status:
                                                        </span>
                                                        not-send</td>
                                                <td class="invoice-list__table-tbody-item-btns">
                                                        <form action="./invoice_preview.php" method="post">
                                                                <input hidden class="invoice-no-hidden-input" name="invoice-no" type="text" value="'.$invoice['no'].'">
                                                                <button class="preview-btn"><i class="fa-solid fa-magnifying-glass"></i>View</button>
                                                        </form>
                                                        <form action="./php_scripts/download_pdf.php" method="post">
                                                                <input hidden class="invoice-id-hidden-input" name="invoice-id" type="text" value="'.$invoice['id'].'">
                                                                <button type="submit">
                                                                        <i class="fa-solid fa-download"></i>
                                                                        Download
                                                                </button>
                                                        </form>
                                                        <button class="delete-btn"><i
                                                                        class="fa-solid fa-trash"></i>Delete</button>
                                                </td>
                                        </tr>';
                                        echo $item;
                                }?>
                        </tbody>
                </table>
        </main>

        <script src="./dist/js/index.min.js"></script>
        <script src="./dist/js/popup_message.min.js"></script>
        <script src="./dist/js/confirm_popup.min.js"></script>
        <script src="./dist/js/invoice_list.min.js"></script>

</body>

</html>